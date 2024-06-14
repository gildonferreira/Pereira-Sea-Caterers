<?php
include 'components/connect.php';

if (isset($_GET['email']) && isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND verification_code = :v_code");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':v_code', $v_code);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if ($result['is_verified'] == 0) {
            $update = $conn->prepare("UPDATE users SET is_verified = 1 WHERE email = :email");
            $update->bindParam(':email', $email);
            if ($update->execute()) {
                echo "
                    <script>
                    alert('Email verification successful');
                    window.location.href='login.php';
                    </script>
                    ";
            } else {
                echo "
                    <script>
                    alert('Cannot run query');
                    window.location.href='register.php';
                    </script>
                    ";
            }
        } else {
            echo "
                <script>
                alert('User is already registered');
                window.location.href='login.php';
                </script>
                ";
        }
    } else {
        echo "
            <script>
            alert('Cannot run query');
            window.location.href='home.php';
            </script>
            ";
    }
}
?>