<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Business Clearance</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            background: #f4f6f9;
        }

        .no-print {
            text-align: center;
            margin: 20px;
        }

        .no-print a,
        .no-print button {
            padding: 8px 16px;
            margin: 4px;
            border: none;
            text-decoration: none;
            color: white;
            background: #0b2d5c;
            cursor: pointer;
        }

        .paper {
            width: 8.5in;
            min-height: 11in;
            margin: auto;
            background: white;
            padding: 45px 65px;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            position: relative;
            min-height: 150px;
        }

        .logo-left {
            width: 100px;
            height: 100px;
            object-fit: contain;
            position: absolute;
            left: 0;
            top: 0;
        }

        .logo-right {
            width: 100px;
            height: 100px;
            object-fit: contain;
            position: absolute;
            right: 0;
            top: 0;
        }

        .seal {
            width: 110px;
            opacity: 0.9;
            margin-top: 20px;
        }

        .title {
            text-align: center;
            margin-top: 40px;
            font-size: 28px;
            font-weight: bold;
            text-decoration: underline;
        }

        .content {
            margin-top: 35px;
            font-size: 18px;
            line-height: 1.9;
            text-align: justify;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
            font-size: 17px;
        }

        .signature img {
            width: 160px;
            height: 60px;
            object-fit: contain;
        }

        .footer {
            margin-top: 50px;
            font-size: 15px;
        }

        @media print {
            body {
                background: white;
            }

            .no-print {
                display: none;
            }

            .paper {
                margin: 0;
                width: 100%;
                min-height: 100vh;
                padding: 45px 65px;
            }
        }
    </style>
</head>
<body>

<div class="no-print">
    <a href="{{ route('business-clearances.index') }}">Back</a>
    <button onclick="window.print()">Print Clearance</button>
</div>

<div class="paper">

            <div class="header">

        {{-- Barangay Logo --}}
        @if($businessClearance->barangay && $businessClearance->barangay->logo)
            <img
                src="{{ asset('storage/'.$businessClearance->barangay->logo) }}"
                class="logo-left">
        @endif

        {{-- Municipality of Baliangao Logo --}}
        <img
            src="{{ asset('images/baliangao-logo.jpg') }}"
            class="logo-right">

        <div>Republic of the Philippines</div>
        <div>Province of Misamis Occidental</div>
        <div>Municipality of Baliangao</div>

        <h2 style="margin-top:10px;">
            BARANGAY {{ strtoupper($businessClearance->barangay->name) }}
        </h2>

        <strong>OFFICE OF THE PUNONG BARANGAY</strong>

    </div>

    <div class="title">
        BUSINESS CLEARANCE
    </div>

    <div class="content">
        <p>
            TO WHOM IT MAY CONCERN:
        </p>

        <p>
            This is to certify that
            <strong>{{ strtoupper($businessClearance->applicant_name) }}</strong>,
            a resident of
            <strong>{{ $businessClearance->applicant_address }}</strong>,
            has requested this clearance for the purpose of securing a
            <strong>{{ $businessClearance->purpose }}</strong>.
        </p>

        <p>
            This further certifies that the business known as
            <strong>{{ strtoupper($businessClearance->business_name) }}</strong>,
            with nature of business
            <strong>{{ $businessClearance->business_type ?? 'N/A' }}</strong>,
            located at
            <strong>{{ $businessClearance->business_address }}</strong>,
            is within the jurisdiction of Barangay
            <strong>{{ $businessClearance->barangay->name ?? '' }}</strong>,
            Municipality of Baliangao, Province of Misamis Occidental.
        </p>

        <p>
            Issued this
            <strong>{{ \Carbon\Carbon::parse($businessClearance->issued_date)->format('jS') }}</strong>
            day of
            <strong>{{ \Carbon\Carbon::parse($businessClearance->issued_date)->format('F Y') }}</strong>
            at Barangay
            <strong>{{ $businessClearance->barangay->name ?? '' }}</strong>,
            Baliangao, Misamis Occidental.
        </p>
    </div>

    <div class="signature">

        @if($businessClearance->barangay && $businessClearance->barangay->captain_signature)
            <img src="{{ asset('storage/'.$businessClearance->barangay->captain_signature) }}">
            <br>
        @endif

        <strong>
            {{ strtoupper($businessClearance->barangay->captain ?? 'PUNONG BARANGAY') }}
        </strong>
        <br>
        Punong Barangay

        <br><br>

        <strong>
            {{ strtoupper($businessClearance->barangay->secretary ?? 'BARANGAY SECRETARY') }}
        </strong>
        <br>
        Barangay Secretary

        <br>

        @if($businessClearance->barangay && $businessClearance->barangay->dry_seal)
            <img src="{{ asset('storage/'.$businessClearance->barangay->dry_seal) }}" class="seal">
        @endif

    </div>

    <div class="footer">
        <p><strong>Clearance No.:</strong> {{ $businessClearance->clearance_no }}</p>
        <p><strong>OR No.:</strong> {{ $businessClearance->or_number ?? 'N/A' }}</p>
        <p><strong>Amount Paid:</strong> ₱{{ number_format($businessClearance->amount_paid ?? 0, 2) }}</p>
    </div>

</div>

</body>
</html>