<?php
// Inside your loop
while ($row = mysqli_fetch_array($result)) {
    $fileExtension = pathinfo($row['file_type'], PATHINFO_EXTENSION);
    $fileIcon = getFileIcon($fileExtension);
?>
    <div class="card" style="width: 18rem;">
        <i class="<?= $fileIcon ?> fa-3x mt-2"></i>
        <div class="card-body text-center">
            <h5 class="card-title"><?= $row['title'] ?></h5>
            <p class="card-text"><?= $row['description'] ?></p>
            <a href="#" class="btn btn-primary d-flex justify-content-center" onclick="viewFile('<?= $row['file_path'] ?>', '<?= $fileExtension ?>')">View</a>
            <!-- You may choose to keep or remove the Download button -->
            <a href="<?= $row['file_path'] ?>" download class="btn btn-secondary d-flex justify-content-center mt-2">Download</a>
        </div>
    </div>
<?php
}
?>
    