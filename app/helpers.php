<?php

use Carbon\Carbon;

if (!function_exists('add_title_tooltip')) {
    function add_title_tooltip($string, $limit = 20)
    {
        if (strlen($string) > $limit) {
            echo 'data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="' . $string . '"';
        }
        echo '';
    }
}

if (!function_exists('getPreviousUrl')) {
    function getPreviousUrl($default)
    {
        $previousUrl = explode('?', url()->previous())[0];
        $currentUrl = explode('?', url()->current())[0];
        if ($previousUrl == $currentUrl || strpos(url()->previous(), 'theme=') !== false) {
            echo $default;
        } else {
            echo url()->previous();
        }
    }
}

if (!function_exists('cleanPhoneNumber')) {
    function cleanPhoneNumber($phone)
    {
        $phone = str_replace('+', '', $phone);
        $phone = str_replace(' ', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        if (!(substr($phone, 0, 2) == '62')) {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }
}

if (!function_exists('getWhatsAppLink')) {
    function getWhatsAppLink($phone)
    {
        return "https://api.whatsapp.com/send?phone=" . cleanPhoneNumber($phone);
    }
}

if (!function_exists('validateAndGetOrder')) {
    function validateAndGetOrder($order)
    {
        if ($order == 'asc' || $order == 'desc') {
            return $order;
        }
        return 'asc';
    }
}

if (!function_exists('isParamsExist')) {
    function isParamsExist($params)
    {
        foreach ($params as $param) {
            if (request($param) != null) {
                return true;
            }
        }
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd M Y')
    {
        return Carbon::parse($date)
            ->locale('en')
            ->settings(['formatFunction' => 'translatedFormat'])
            ->format($format);
    }
}

if (!function_exists('nowId')) {
    function nowId($format = 'Y-m-d H:i:s')
    {
        return Carbon::now()
            ->locale('id')
            ->settings(['formatFunction' => 'translatedFormat'])
            ->format($format);
    }
}

if (!function_exists('isPast')) {
    function isPast($dateTime)
    {
        return Carbon::parse($dateTime)->isPast();
    }
}

if (!function_exists('isNotStarted')) {
    function isNotStarted($dateTime)
    {
        return Carbon::parse($dateTime)->isFuture();
    }
}

if (!function_exists('isOngoing')) {
    function isOngoing($startDateTime, $endDateTime)
    {
        return Carbon::parse($startDateTime)->isPast() && Carbon::parse($endDateTime)->isFuture();
    }
}

if (!function_exists('getAttendanceStatusColor')) {
    function getAttendanceStatusColor($status)
    {
        $status = strtolower($status);
        if ($status == 'hadir') {
            return 'success';
        } elseif ($status == 'izin') {
            return 'yellow';
        } elseif ($status == 'alpha') {
            return 'danger';
        } elseif ($status == 'sakit') {
            return 'azure';
        }
    }
}

if (!function_exists('getLogStatusColor')) {
    function getLogStatusColor($status)
    {
        $status = strtolower($status);
        if ($status == 'create') {
            return 'indigo';
        } elseif ($status == 'delete') {
            return 'red';
        } elseif ($status == 'update') {
            return 'yellow';
        } elseif ($status == 'login') {
            return 'teal';
        } elseif ($status == 'logout') {
            return 'pink';
        } elseif ($status == 'other') {
            return 'purple';
        }
    }
}

if (!function_exists('countPercentage')) {
    function countPercentage($total, $count, $round = 2)
    {
        if ($total == 0) {
            return 0;
        }
        return round(($count / $total) * 100, $round);
    }
}

if (!function_exists('getCardStatusColor')) {
    function getCardStatusColor($attendance)
    {
        if ($attendance->status->name == 'Hadir') {
            return 'success';
        } elseif ($attendance->status->name == 'Izin') {
            return 'warning';
        } elseif ($attendance->status->name == 'Sakit') {
            return 'azure';
        } else {
            if (isNotStarted($attendance->schedule->date . ' ' . $attendance->schedule->start)) {
                return 'secondary';
            } elseif (isOngoing($attendance->schedule->date . ' ' . $attendance->schedule->start, $attendance->schedule->date . ' ' . $attendance->schedule->end)) {
                return 'primary';
            } else {
                return 'danger';
            }
        }
    }
}

if (!function_exists('getProfileRoute')) {
    function getProfileRoute($role)
    {
        if ($role == 'student') {
            return route('student.profile.index');
        } elseif ($role == 'administrator') {
            return route('admin.profile.index');
        } elseif ($role == 'mentor') {
            return route('mentor.profile.index');
        }
    }
}

if (!function_exists('getQueryParamsString')) {
    function getQueryParamsString()
    {
        $url = request()->fullUrl();
        $queryParamsString = explode('?', $url)[1] ?? '';
        return $queryParamsString;
    }
}

if (!function_exists('getRepeaterInput')) {
    function getRepeaterInput($index, $name, $value = "")
    {
        return '
            <li class="mb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div style="width: 70%;">
                        <input type="text" class="form-control form-control-flush d-inline-block ' . $name . '-input" placeholder="Enter ' . $name . '" name="' . $name . '[' . $index . ']" value="' . $value .'">
                    </div>
                    <div>
                        <a class="link-secondary cursor-pointer" onclick="removeRepeaterInput(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                        </a>
                    </div>
                </div>
            </li>
        ';
    }
}

if (!function_exists('getJobTypeColor')) {
    function getJobTypeColor($jobType)
    {
        if ($jobType == 'full-time') {
            return 'primary';
        } elseif ($jobType == 'internship') {
            return 'success';
        } elseif ($jobType == 'part-time') {
            return 'pink';
        } elseif ($jobType == 'freelance') {
            return 'purple';
        } else {
            return 'gray';
        }
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}
