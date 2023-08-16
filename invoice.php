<!DOCTYPE html>
<html>
<head>
  <title>Printable Form</title>
  <style>
    /* Define your CSS styles for the printable form */
    @media print {
      /* Specify the styles to be applied when printing */
      /* Hide any elements that should not be printed */
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="no-print">
    <!-- Add a button to trigger the print functionality -->
    <button onclick="window.print()">Print Form</button>
  </div>
  
  <!-- Your form content goes here -->
  <form>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <br>
    <!-- Add more form fields as needed -->
  </form>
  
  <script>
    // Add any JavaScript logic here
  </script>
</body>
</html>
