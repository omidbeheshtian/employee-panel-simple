<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                # Register User
                function isUserExists($username)
                    {
                        global $pdo;
                        $sql = "SELECT * FROM users WHERE username = :username";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([':username' => $username]);
                        return $stmt->rowCount();
                    }
                    /*
                    تابع بالا یک نام کاربری به عنوان ورودی دریافت می‌کند و یک کوئری به سمت پایگاه داده می‌زند تا بررسی کند کاربری که اطلاعات را اسال کرده است موجود است یا خیر؟ ما تابع بالا را درون تابع register استفاده می‌کنیم که اگر کاربر موجود بود او را به صفحه‌‌ی لاگین هدایت کنیم و اگر کاربر موجود نبود او را ثبت نام می‌کنیم.
                    */
                    function register($username, $password)
                        {
                            global $pdo;
                            if (isUserExists($username)) {
                                return false;
                            }
                            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([':username' => $username, ':password' => $password]);
                            return $stmt->rowCount();
                        }
                        /*
                        در تابع register ما یک شرط آورده‌ایم و اگر کاربر موجود بود false را به عنوان خروجی تابع برمی‌گردانیم تا بتوانیم به او اطلاع بدهیم تا عمل لاگین را انجام دهد. اگر هم کاربر موجود نبود و از قبل ثبت نام نکرده بود ادامه‌ی کد اجرا می‌شود و کاربر در سیستم ما ثبت نام می‌شود.
                        */
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['username']) and isset($_POST['password'])) {
                                if (!empty($_POST['username']) and !empty($_POST['password'])) {
                                    if (isset($_POST['register'])) {
                                        if (register($_POST['username'], $_POST['password'])) {
                                            header("location: register.php?s=1");
                                            exit;
                                        }else{
                                            header("location: register.php?s=0");
                                            exit;
                                        }
                                        }elseif (isset($_POST['login'])) {
                                        if (login($_POST['username'], $_POST['password'])) {
                                            header("location: login.php?s=1");
                                            exit;
                                        } else {
                                            header("location: login.php?s=0");
                                            exit;
                                        }
                                    }
                                }
                            }
                        }
                        /*
                        در بلاک شرط register ما بررسی کرده‌ایم که اگر خروجی تابع register درست یا true بود به صفحه‌ی register.php برگشت داده شود و در URL برگشت داده شده ما یک مقدار s=1 را نیز قرار داده‌ایم تا بتوانیم در صفحه‌ی مقصد پیام مرتبط را چاپ کنیم. در بخش else هم زمانی اجرا می‌شود که درون تابع register تابع isUserExists اجرا شده است و تابع به این نتیجه رسیده است که کاربر موجود است و نیازی به ثبت نام دوباره ندارد پس مقدار بازگشتی تابع 0 خواهد بود و ما می‌توانیم پیام مرتبط با آن را نیز نمایش بدهیم.
                        */
            } elseif (isset($_POST['login'])) {
                # Login User
                function login($username, $password)
                {
                    global $pdo;
                    if (!isUserExists($username)) {
                        return false;
                    }
                    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':username' => $username, ':password' => $password]);
                    $result = $stmt->fetch(PDO::FETCH_OBJ);
                    $_SESSION['login'] = $result->id;
                    return true;
                }
                    /*
                    درون تابع لاگین ما اول بررسی کرده‌ایم که آیا کاربر از قبل وجود دارد؟ اگر کاربر از قبل ثبت نام کرده بود ما در ادامه‌ی کد با یک کوئری بررسی می‌کنیم ببینیم آیا نام کاربری و رمز عبورش درست است. اگر درست بود یک SESSION برای کاربر با id خودش ثبت می‌کنیم
                    */
                    
            }
        }
    }
}