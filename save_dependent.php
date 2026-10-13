
<?php
// ตรวจสอบว่ามีการส่งข้อมูลด้วย POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('ไม่อนุญาตให้เข้าถึงหน้านี้โดยตรง');
}

// ฟังก์ชันป้องกัน XSS เมื่อแสดงข้อมูล
function e($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}

// รับข้อมูลจากฟอร์ม
$fullname = trim($_POST['fullname'] ?? '');
$age = trim($_POST['age'] ?? '');
$address = trim($_POST['address'] ?? '');
$caregiverCode = trim($_POST['caregiver_code'] ?? '');
$needs = $_POST['needs'] ?? [];
$otherDetail = trim($_POST['other_needs_detail'] ?? '');

// ตรวจสอบข้อมูล Checkbox
if (!is_array($needs)) {
    $needs = [];
}

// กรองค่า Checkbox ให้เป็นข้อความ
$needs = array_filter($needs, 'is_string');

// หากเลือกอื่น ๆ ให้แสดงรายละเอียดเพิ่มเติม
if (in_array('อื่น ๆ', $needs, true) && $otherDetail !== '') {
    $needs[] = 'รายละเอียดอื่น ๆ: ' . $otherDetail;
}

// ตรวจสอบว่ามีการเลือกความต้องการหรือไม่
if (empty($_POST['needs'])) {
    $needs = [];
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ข้อมูลบุคคลภาวะพึ่งพิง</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px 15px;
            min-height: 100vh;
            font-family: Tahoma, sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #eff6ff);
            color: #1e293b;
        }

        .container {
            max-width: 850px;
            margin: 30px auto;
            padding: 32px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 12px 35px rgba(30, 64, 175, 0.12);
        }

        h1 {
            margin-top: 0;
            color: #1d4ed8;
            text-align: center;
            font-size: 26px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 28px;
        }

        .info-item {
            padding: 16px;
            margin-bottom: 12px;
            background: #f8fbff;
            border: 1px solid #dbeafe;
            border-radius: 10px;
        }

        .label {
            display: block;
            margin-bottom: 7px;
            color: #1d4ed8;
            font-weight: bold;
        }

        .value {
            line-height: 1.8;
            overflow-wrap: anywhere;
            white-space: pre-wrap;
        }

        .needs-list {
            margin: 0;
            padding-left: 24px;
        }

        .needs-list li {
            margin-bottom: 8px;
        }

        .empty {
            color: #94a3b8;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            display: inline-block;
            padding: 13px 22px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: #2563eb;
            color: #ffffff;
        }

        .btn-back:hover {
            background: #1d4ed8;
        }

        .btn-print {
            background: #e2e8f0;
            color: #334155;
        }

        @media (max-width: 480px) {
            .container {
                padding: 22px 16px;
                margin: 10px auto;
            }

            h1 {
                font-size: 21px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }
        }

        @media print {
            body {
                background: #ffffff;
            }

            .container {
                box-shadow: none;
                margin: 0 auto;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>ข้อมูลบุคคลกลุ่มภาวะพึ่งพิง</h1>

    <p class="subtitle">
        รายละเอียดข้อมูลที่ได้รับจากแบบฟอร์ม
    </p>

    <div class="info-item">
        <span class="label">1. ชื่อ-สกุล</span>
        <div class="value">
            <?= e($fullname !== '' ? $fullname : '-') ?>
        </div>
    </div>

    <div class="info-item">
        <span class="label">2. อายุ</span>
        <div class="value">
            <?= e($age !== '' ? $age . ' ปี' : '-') ?>
        </div>
    </div>

    <div class="info-item">
        <span class="label">3. ที่อยู่ปัจจุบัน</span>
        <div class="value">
            <?= e($address !== '' ? $address : '-') ?>
        </div>
    </div>

    <div class="info-item">
        <span class="label">4. ความต้องการ</span>

        <?php if (!empty($needs)): ?>
            <ul class="needs-list">
                <?php foreach ($needs as $need): ?>
                    <li><?= e($need) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty">ไม่ได้เลือกรายการความต้องการ</div>
        <?php endif; ?>
    </div>

    <div class="info-item">
        <span class="label">5. รหัสผู้ดูแล (อสม.)</span>
        <div class="value">
            <?= e($caregiverCode !== '' ? $caregiverCode : '-') ?>
        </div>
    </div>

    <div class="actions">
        <a href="people.php" class="btn btn-back">
            ← กลับหน้าหลัก
        </a>

        <button
            type="button"
            class="btn btn-print"
            onclick="window.print()">
            พิมพ์ข้อมูล
        </button>
    </div>

</div>

</body>
</html>