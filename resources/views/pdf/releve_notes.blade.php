<!DOCTYPE html>
<html dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url(http://tarantula.unl.edu/fonts/dejavu-sans/DejaVuSans.ttf) format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1a56db;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #1a56db;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .school-info {
            margin-bottom: 20px;
        }
        .student-info {
            width: 100%;
            margin-bottom: 30px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
        }
        .student-info td {
            padding: 5px;
        }
        .label {
            font-bold: bold;
            color: #64748b;
            width: 150px;
        }
        .value {
            font-weight: bold;
            color: #1e293b;
        }
        table.notes-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table.notes-table th {
            background-color: #1a56db;
            color: white;
            padding: 10px;
            text-align: {{ $isRtl ? 'right' : 'left' }};
        }
        table.notes-table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
        }
        table.notes-table tr:nth-child(even) {
            background-color: #f1f5f9;
        }
        .summary {
            float: {{ $isRtl ? 'left' : 'right' }};
            width: 250px;
            margin-top: 20px;
        }
        .summary-table {
            width: 100%;
            border: 1px solid #1a56db;
        }
        .summary-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
        }
        .footer {
            margin-top: 100px;
            text-align: center;
        }
        .signature-box {
            display: inline-block;
            width: 200px;
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 10px;
        }
        .rtl { direction: rtl; }
        .ltr { direction: ltr; }
    </style>
</head>
<body class="{{ $isRtl ? 'rtl' : 'ltr' }}">
    <div class="header">
        <h1>{{ $ar->utf8Glyphs(__('app.releve_notes')) }}</h1>
        <p>{{ $ar->utf8Glyphs(config('app.name')) }}</p>
    </div>

    <div class="student-info">
        <table width="100%">
            <tr>
                <td class="label">{{ $ar->utf8Glyphs(__('app.nom_prenom')) }}:</td>
                <td class="value">{{ $ar->utf8Glyphs($etudiant->nom . ' ' . $etudiant->prenom) }}</td>
                <td class="label">{{ $ar->utf8Glyphs(__('app.matricule')) }}:</td>
                <td class="value">{{ $etudiant->matricule }}</td>
            </tr>
            <tr>
                <td class="label">{{ $ar->utf8Glyphs(__('app.classe')) }}:</td>
                <td class="value">{{ $ar->utf8Glyphs($etudiant->classe->nom_classe ?? 'N/A') }}</td>
                <td class="label">{{ $ar->utf8Glyphs(__('app.date_impression')) }}:</td>
                <td class="value">{{ now()->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="notes-table">
        <thead>
            <tr>
                <th>{{ $ar->utf8Glyphs(__('app.matiere')) }}</th>
                <th>{{ $ar->utf8Glyphs(__('app.evaluation')) }}</th>
                <th style="text-align: center;">{{ $ar->utf8Glyphs(__('app.note')) }}</th>
                <th>{{ $ar->utf8Glyphs(__('app.remarques')) }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{ $ar->utf8Glyphs($note->evaluation->matiere->nom_matiere ?? 'N/A') }}</td>
                    <td>{{ $ar->utf8Glyphs($note->evaluation->titre ?? __('app.evaluation')) }}</td>
                    <td style="text-align: center;">
                        <span style="font-weight: bold; color: {{ $note->note >= 10 ? '#10b981' : '#ef4444' }};">
                            {{ number_format($note->note, 2) }} / 20
                        </span>
                        @if(isset($note->is_absence) && $note->is_absence)
                            <br><small style="color: #ef4444; font-size: 8px;">{{ $ar->utf8Glyphs(__('app.absent_ou_non_note')) }}</small>
                        @endif
                    </td>
                    <td>{{ $ar->utf8Glyphs($note->commentaire ?? '—') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <table class="summary-table">
            <tr>
                <td><strong>{{ $ar->utf8Glyphs(__('app.moyenne_generale')) }}</strong></td>
                <td style="text-align: center; font-weight: bold; font-size: 14px;">
                    {{ number_format($moyenne, 2) }} / 20
                </td>
            </tr>
            <tr>
                <td><strong>{{ $ar->utf8Glyphs(__('app.mention')) }}</strong></td>
                <td style="text-align: center;">{{ $ar->utf8Glyphs($mention) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="footer">
        <div style="float: {{ $isRtl ? 'right' : 'left' }}; width: 300px;">
            <p>{{ $ar->utf8Glyphs(__('app.cachet_ecole')) }}</p>
            <div class="signature-box"></div>
        </div>
        <div style="float: {{ $isRtl ? 'left' : 'right' }}; width: 300px;">
            <p>{{ $ar->utf8Glyphs(__('app.signature_directeur')) }}</p>
            <div class="signature-box"></div>
        </div>
    </div>
</body>
</html>
