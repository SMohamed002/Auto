<?php

class Info
{
    public static $DB_HOSTNAME = '127.0.0.1',
        $DB_USERNAME = 'root',
        $DB_PASSWORD = '',
        $DB_NAME = 'pharmacy',
        $P_KEYS = ['s', 'd', 'i', 'b'],
        $conn = null;

    public static function open_conn()
    {
        if (empty(Info::$conn)) {
            Info::$conn = mysqli_connect(Info::$DB_HOSTNAME, Info::$DB_USERNAME, Info::$DB_PASSWORD, Info::$DB_NAME);
            if (!Info::$conn) {
                die('Could not connect to db because : ' . mysqli_connect_error());
            }
            Info::$conn->set_charset('utf8');
            //mysqli_query(Info::$conn, 'SET CHARACTER SET UTF8');
        }
    }

    public static function close_conn()
    {
        if (!empty(Info::$conn)) {
            mysqli_close(Info::$conn);
        }
    }

    public static function executeQuery($sql, $params = null)
    {
        if (!empty($sql)) {
            $rslt = false;
            try {
                Info::open_conn();
                $stmt = mysqli_prepare(Info::$conn, $sql);
                if (!empty($params)) {
                    $types = '';
                    $ps = [];
                    foreach ($params as $val) {
                        $val = explode('_', $val);
                        $types .= $val[0];
                        $ps[] = $val[1];
                    }
                    //call_user_func_array('mysqli_stmt_bind_param', $ps);
                    mysqli_stmt_bind_param($stmt, $types, ...$ps);
                }
                $rslt = $stmt->execute();
                mysqli_stmt_close($stmt);
            } catch (Exception $e) {
                echo $e;
                die();
            } finally {
                return $rslt;
            }
        }
    }

    public static function getQuery($sql, $params = null)
    {
        if (!empty($sql)) {
            $rslt = [];
            try {
                Info::open_conn();
                $stmt = mysqli_prepare(Info::$conn, $sql);
                if (!empty($params)) {
                    $types = '';
                    $ps = [];
                    foreach ($params as $val) {
                        $val = explode('_', $val);
                        $types .= $val[0];
                        $ps[] = $val[1];
                    }
                    //call_user_func_array('mysqli_stmt_bind_param', $ps);
                    mysqli_stmt_bind_param($stmt, $types, ...$ps);
                }
                if ($stmt->execute()) {
                    $rslt = mysqli_fetch_all($stmt->get_result(), MYSQLI_BOTH);
                }
                mysqli_stmt_close($stmt);
            } catch (Exception $e) {
                echo $e;
                die();
            } finally {
                return $rslt;
            }
        }
    }

    public static function checkQuery($sql, $params = null)
    {
        if (!empty($sql)) {
            $rslt = false;
            try {
                Info::open_conn();
                $stmt = mysqli_prepare(Info::$conn, $sql);
                if (!empty($params)) {
                    $types = '';
                    $ps = [];
                    foreach ($params as $val) {
                        $val = explode('_', $val);
                        $types .= $val[0];
                        $ps[] = $val[1];
                    }
                    //call_user_func_array('mysqli_stmt_bind_param', $ps);
                    mysqli_stmt_bind_param($stmt, $types, ...$ps);
                }
                if ($stmt->execute()) {
                    $rslt = mysqli_fetch_all($stmt->get_result(), MYSQLI_BOTH);
                    $rslt = !empty($rslt) && is_countable($rslt) && count($rslt) > 0;
                }
                mysqli_stmt_close($stmt);
            } catch (Exception $e) {
                echo $e;
                die();
            } finally {
                return $rslt;
            }
        }
    }
}
