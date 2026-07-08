<!DOCTYPE html>
<html>
<head>
    <title>Sertifikat Kelulusan</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            text-align: center; 
            color: #333;
        }
        .container { 
            border: 8px solid #047857; /* Warna Hijau Emerald Khas Akademi Islami */
            padding: 40px; 
            margin: 20px; 
            border-radius: 10px;
        }
        .header { 
            font-size: 38px; 
            font-weight: bold; 
            color: #047857; 
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        .subtitle { 
            font-size: 22px; 
            color: #555; 
            margin-bottom: 50px; 
            text-transform: uppercase;
        }
        .presented-text {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .name { 
            font-size: 45px; 
            font-weight: bold; 
            text-decoration: underline; 
            margin-bottom: 40px; 
            color: #111;
        }
        .description { 
            font-size: 20px; 
            margin-bottom: 60px; 
            line-height: 1.6; 
        }
        .footer { 
            font-size: 16px; 
            margin-top: 40px; 
        }
        .signature-line { 
            border-top: 1px solid #000; 
            width: 250px; 
            margin: 80px auto 5px auto; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">SERTIFIKAT KELULUSAN</div>
        <div class="subtitle">AKADEMI ISLAMI</div>
        
        <div class="presented-text">Diberikan dengan penuh rasa bangga kepada:</div>
        
        <div class="name">{{ $nama_siswa }}</div>
        
        <div class="description">
            Atas dedikasi dan keberhasilannya menyelesaikan seluruh materi evaluasi<br>
            dengan nilai yang sangat memuaskan pada <strong>{{ $kursus }}</strong>.
        </div>
        
        <div class="footer">
            <p>Disahkan pada tanggal: <strong>{{ $tanggal }}</strong></p>
            
            <div class="signature-line"></div>
            <p><strong>Administrator Utama</strong></p>
        </div>
    </div>
</body>
</html>