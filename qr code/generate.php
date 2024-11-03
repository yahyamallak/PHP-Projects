<?php
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Writer\WebPWriter;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;


define( "HOME", "/php-projects/qr code");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require_once './vendor/autoload.php';

    
    
    $errors = [];
    
    $text = $_POST["text"];


    $logo = null;

    $label = null;
    
    $type = empty($_POST["type"]) ? "png" : $_POST["type"];
    
    
    if(empty($text)) {
        $errors["text"] = "Text is required";
    }
    
    
    if (empty($errors)) {
        
        $size = empty($_POST["size"]) ? 300 : $_POST["size"];
        
        $margin = empty($_POST["margin"]) ? 0 : $_POST["margin"];
        
        $errorCorrectionLevel = $_POST["errorCorrectionLevel"];

        if($errorCorrectionLevel == 'low') {
            $errorCorrectionLevel = ErrorCorrectionLevel::Low;
        } else if ($errorCorrectionLevel == 'quartile') {
            $errorCorrectionLevel = ErrorCorrectionLevel::Quartile;
        } else if ($errorCorrectionLevel == 'high') {
            $errorCorrectionLevel = ErrorCorrectionLevel::High;
        } else {
            $errorCorrectionLevel =  ErrorCorrectionLevel::Medium;
        }

        
        if (!empty($_POST["foreground"])) {

            $foregroundColor = str_split(trim($_POST["foreground"], '#'), 2);
            $foreground = new Color(hexdec($foregroundColor[0]), hexdec($foregroundColor[1]), hexdec($foregroundColor[2]));

        } else {

            $foreground = new Color(0, 0, 0);
        }

        if (!empty($_POST["background"])) {

            $backgroundColor = str_split(trim($_POST["background"], '#'), 2);
            $background = new Color(hexdec($backgroundColor[0]), hexdec($backgroundColor[1]), hexdec($backgroundColor[2]));

        } else {
            $background = new Color(255, 255, 255);
        }


        if (!empty($type) && $type == "svg") {
            $writer = new SvgWriter;
        } else if (!empty($type) && $type == "webp") {
            $writer = new WebPWriter;
        } else if (!empty($type) && $type == "pdf") {
            $writer = new PdfWriter;
        } else {
            $writer = new PngWriter;
        }

        $qr_code = QrCode::create($text)
            ->setSize($size)
            ->setMargin($margin)
            ->setForegroundColor($foreground)
            ->setBackgroundColor($background)
            ->setErrorCorrectionLevel($errorCorrectionLevel);

        if (!empty($_FILES['logo']['name'])) {
            
            $tempPath = $_FILES['logo']['tmp_name'];

            $logoWidth = empty($_POST["width"]) ? 50 : $_POST["width"];

            $folder = "files/uploads/";

            if (!is_dir($folder)) {
                mkdir($folder);
            }

            $logoPath = $folder . time() . "." . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);

            if(move_uploaded_file($tempPath, $logoPath)) {
                $logo = Logo::create($logoPath)
                            ->setResizeToWidth($logoWidth);
            }

        }



        $labelText = $_POST["label"];


        if(!empty($_POST["labelColor"])) {

            $labelColors = str_split(trim($_POST["labelColor"], '#'), 2);
            $labelColor = new Color(hexdec($labelColors[0]), hexdec($labelColors[1]), hexdec($labelColors[2]));

        } else {
            $labelColor =  new Color(0,0,0);
        }


        $labelPosition = $_POST["label"];


        if($labelPosition == 'right') {
            $labelPosition = LabelAlignment::Right;
        } else if($labelPosition == 'left') {
            $labelPosition = LabelAlignment::Left;
        } else {
            $labelPosition = LabelAlignment::Center;
        }


        if(!empty($labelText)) {

            if($labelPosition == 'right') {
                $labelPosition = LabelAlignment::Right;
            } else if($labelPosition == 'left') {
                $labelPosition = LabelAlignment::Left;
            } else if($labelPosition == 'center') {
                $labelPosition = LabelAlignment::Center;
            }

            $label = Label::create($labelText)
                        ->setTextColor($labelColor)
                        ->setAlignment($labelPosition);
        }



        $result = $writer->write($qr_code, $logo, $label);

        $folder = "files/" . $type;
        $file = $folder . "/" . time() . "." . $type;

        if(!is_dir($folder)) {
            mkdir($folder);
        }

        $result->saveToFile($file);

        session_start();

        function humanFileSize($size, $unit = "")
        {
            if ((!$unit && $size >= 1 << 30) || $unit == "GB") {
                return number_format($size / (1 << 30), 2) . "GB";
            }

            if ((!$unit && $size >= 1 << 20) || $unit == "MB") {
                return number_format($size / (1 << 20), 2) . "MB";
            }

            if ((!$unit && $size >= 1 << 10) || $unit == "KB") {
                return number_format($size / (1 << 10), 2) . "KB";
            }

            return number_format($size) . " bytes";
        }



        $_SESSION["file"] = $file;
        $_SESSION["file_size"] = humanFileSize(filesize($file));
        $_SESSION["file_width"] = $size;
        $_SESSION["file_type"] = strtoupper($type);
        $_SESSION["download"] = true;
        unset($_SESSION["errors"]);

    } else {
        session_start();
        $_SESSION["errors"] = $errors;
        $_SESSION["file"] = HOME . "/files/qr-code.jpg";
        unset($_SESSION["download"]);
    }
    

    header("Location: " . HOME);
    exit;
}