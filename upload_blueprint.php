<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en', 
    includedLanguages: 'en,fr,es,de,it,pt,zh-CN,ar,ru,ja,hi,bn,ko,tr,vi,pl,nl,th,sw,yo', 
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php
// 1. Configuration
$targetDir = "uploads/";
$response = ["status" => "error", "message" => "Unknown error"];

// 2. Check if file was actually sent
if (isset($_FILES["blueprint"])) {
    $fileName = basename($_FILES["blueprint"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $fileName; // Adds timestamp to avoid overwriting
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // 3. Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'docx');
    
    if (in_array(strtolower($fileType), $allowTypes)) {
        // 4. Upload file to server
        if (move_uploaded_file($_FILES["blueprint"]["tmp_name"], $targetFilePath)) {
            $response["status"] = "success";
            $response["message"] = "The file " . $fileName . " has been uploaded successfully.";
        } else {
            $response["message"] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $response["message"] = "Sorry, only JPG, JPEG, PNG, PDF, & DOCX files are allowed.";
    }
}

echo json_encode($response);
?>