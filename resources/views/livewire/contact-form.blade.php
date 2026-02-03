<div class="max-w-lg mx-auto">
    <!-- Success Message -->
    @if($showSuccess)
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-green-800 font-medium">Thank you for your message! We will get back to you soon.</p>
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if($showError)
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-red-800 font-medium">Sorry, there was an error sending your message. Please try again later.</p>
            </div>
        </div>
    @endif

    <form wire:submit="submit" class="space-y-6">
        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Full Name <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="name" 
                   wire:model.live.debounce.300ms="name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors
                          @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                   placeholder="Enter your full name"
                   required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email Address <span class="text-red-500">*</span>
            </label>
            <input type="email" 
                   id="email" 
                   wire:model.live.debounce.300ms="email"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors
                          @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                   placeholder="Enter your email address"
                   required>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Field -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                Phone Number (Optional)
            </label>
            <input type="tel" 
                   id="phone" 
                   wire:model.live.debounce.300ms="phone"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors
                          @error('phone') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                   placeholder="Enter your phone number">
            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Subject Field -->
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                Subject <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="subject" 
                   wire:model.live.debounce.300ms="subject"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors
                          @error('subject') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                   placeholder="What is this message about?"
                   required>
            @error('subject')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Message Field -->
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                Message <span class="text-red-500">*</span>
            </label>
            <textarea id="message" 
                      wire:model.live.debounce.300ms="message"
                      rows="5"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors resize-none
                             @error('message') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                      placeholder="Enter your message here..."
                      required></textarea>
            @error('message')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <div class="mt-1 text-right text-xs text-gray-500">
                {{ strlen($message) }}/2000 characters
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" 
                    wire:loading.attr="disabled"
                    class="w-full bg-primary hover:bg-secondary text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="submit">
                    Send Message
                </span>
                <span wire:loading wire:target="submit" class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sending...
                </span>
            </button>
        </div>

        <!-- Required Fields Note -->
        <div class="text-xs text-gray-500 text-center">
            <span class="text-red-500">*</span> Required fields
        </div>
    </form>
</div>
