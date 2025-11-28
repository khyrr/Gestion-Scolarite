# API Logging Implementation Proposal

This document outlines the recommended approach for implementing a dedicated API logging system in the application.

## 1. Database Schema (`api_logs`)

Create a dedicated table to store API request details. This separates technical logs from business activity logs.

```php
Schema::create('api_logs', function (Blueprint $table) {
    $table->id();
    $table->string('method');       // GET, POST, PUT, DELETE
    $table->string('url');          // /api/v1/students
    $table->integer('status');      // 200, 401, 500
    $table->string('ip');           // 192.168.1.1
    $table->float('duration');      // Duration in milliseconds (e.g., 45.20)
    $table->unsignedBigInteger('user_id')->nullable(); // If authenticated
    $table->json('payload')->nullable();   // Request body (sanitize passwords!)
    $table->text('response')->nullable();  // Response body (truncate if needed)
    $table->string('user_agent')->nullable();
    $table->timestamps();
    
    // Indexes for performance
    $table->index('status');
    $table->index('user_id');
    $table->index('created_at');
});
```

## 2. Middleware Implementation

Create a middleware `LogApiRequests` to intercept and log every request.

**Command:** `php artisan make:middleware LogApiRequests`

```php
namespace App\Http\Middleware;

use Closure;
use App\Models\ApiLog;
use Illuminate\Support\Facades\Auth;

class LogApiRequests
{
    public function handle($request, Closure $next)
    {
        $startTime = microtime(true);
        
        // Process the request
        $response = $next($request);
        
        // Calculate duration
        $duration = round((microtime(true) - $startTime) * 1000, 2);
        
        // Log the details
        ApiLog::create([
            'method'    => $request->method(),
            'url'       => $request->path(),
            'status'    => $response->status(),
            'ip'        => $request->ip(),
            'duration'  => $duration,
            'user_id'   => Auth::id(),
            'payload'   => json_encode($request->except(['password', 'password_confirmation'])),
            'user_agent'=> $request->userAgent(),
            // 'response' => $response->getContent(), // Optional: can be heavy
        ]);

        return $response;
    }
}
```

## 3. Register Middleware

Add the middleware to your `api` middleware group in `app/Http/Kernel.php`.

```php
protected $middlewareGroups = [
    'api' => [
        // ... other middleware
        \App\Http\Middleware\LogApiRequests::class,
    ],
];
```

## 4. Dashboard UI Recommendations

For the index view (`admin.api-logs.index`), aim for a "Network Monitor" look:

*   **Status Indicators:**
    *   Use color-coded badges for status codes.
    *   🟢 **2xx** (Success)
    *   🟠 **4xx** (Client Error)
    *   🔴 **5xx** (Server Error)
*   **Method Badges:** Distinct colors for GET (Blue), POST (Green), DELETE (Red).
*   **Performance Highlighting:** Highlight rows where `duration > 1000ms` in yellow/red to spot slow endpoints.
*   **Filtering:**
    *   "Show Errors Only" (Status >= 400)
    *   "Slow Requests" (Duration > 1s)
    *   Filter by User or IP.
