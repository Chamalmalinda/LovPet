<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lost Pet Notice - LovPet</title>
  <link rel="stylesheet" href="lost-notice.css" />
</head>
<body>

  <div class="notice-container">
    <h2>Report a Lost Pet</h2>
    
    
   <form class="notice-form" action="seller-save-notice.php" method="POST" enctype="multipart/form-data">


      
      <label>Upload Image</label>
      <div class="upload-box" id="upload-box">
        <p id="upload-text">Drag and drop image here or click to select</p>
        <input type="file" id="imageUpload" name="image" accept="image/*" hidden>
        <div class="preview-container" style="display: none;">
          <img id="previewImage" src="" alt="Preview">
        </div>
      </div>

      
      <label for="petName">Pet Name</label>
      <input type="text" id="petName" name="petName" required>

      <label for="breed">Breed</label>
      <input type="text" id="breed" name="breed" required>

      <label for="location">Last Seen Location</label>
      <input type="text" id="location" name="location" required>

      <label for="contact">Contact Number</label>
      <input type="tel" id="contact" name="contact" required>

      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" required></textarea>

     
      <div class="btn-group">
        <button type="submit" class="submit-btn">Submit Notice</button>
        <button type="button" class="cancel-btn" onclick="window.location.href='seller-display-notice.php'">Cancel</button>
      </div>
    </form>
  </div>

  
  <script>
    const uploadBox = document.getElementById('upload-box');
    const imageInput = document.getElementById('imageUpload');
    const previewImage = document.getElementById('previewImage');
    const uploadText = document.getElementById('upload-text');
    const previewContainer = document.querySelector('.preview-container');

    uploadBox.addEventListener('click', () => imageInput.click());

    uploadBox.addEventListener('dragover', e => {
      e.preventDefault();
      uploadBox.classList.add('dragover');
    });

    uploadBox.addEventListener('dragleave', () => {
      uploadBox.classList.remove('dragover');
    });

    uploadBox.addEventListener('drop', e => {
      e.preventDefault();
      uploadBox.classList.remove('dragover');
      imageInput.files = e.dataTransfer.files;
      previewSelectedImage(imageInput.files[0]);
    });

    imageInput.addEventListener('change', () => {
      if (imageInput.files && imageInput.files[0]) {
        previewSelectedImage(imageInput.files[0]);
      }
    });

    function previewSelectedImage(file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result;
        previewContainer.style.display = 'block';
        uploadText.style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
  </script>

</body>
</html>
