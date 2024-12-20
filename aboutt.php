<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shortcuts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Learn Keyboard Shortcuts!</h3>
         <p>Mastering keyboard shortcuts can greatly enhance productivity and efficiency. 
            This section provides a list of essential shortcuts to help you navigate and 
            operate smoothly, saving time on common tasks. </p>
         <a href="courses.html" class="inline-btn">our courses</a>
      </div>

   </div>

   <div class="box-container">

      <div class="box active">
         
         <i class="fa-solid fa-file-word"></i>
            <div>
            <h3>Microsoft Word</h3>
            <span>Keyboard Shortcuts</span>
            </div>
         </div>

         <div class="box excel-box">
         <i class="fa-solid fa-file-excel"></i>
            <div>
            <h3>Microsoft Excel</h3>
            <span>Keyboard Shortcuts</span>
            </div>
         </div>

      </div>
    

   </div>

   <div class="box-container">
   <h1>Document Shortcuts</h1>
   </div>

   <div class="box-container">

   <table>
    <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
    </tr>
    <tr>
      <td>CTRL + N</td>
      <td>Copy New Document</td>
      <td><div class="btn-s"><a target="_blank" href="ms/CTRL+N.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + S</td>
      <td>Save the Document</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+S.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Z</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+Z.gif">View</a></div></td>
    </tr>
      <td>CTRL + A</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+A.gif">View</a></div></td>
    <tr>
      <td>F7</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/F7.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + F4</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+F4.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + P</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+P.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Y</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+Y.gif">View</a></div></td>
    </tr>
    <tr>
      <td>F4</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/F4.gif">View</a></div></td>
    </tr>
    <tr>
      <td>F9</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/F9.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + ALT + T</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+ALT+T.gif">View</a></div></td>
    </tr>
    <tr>=
      <td>CTRL + ALT + C</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+ALT+C.gif">View</a></div></td>
    </tr>

  </table>
 
   </div>

   <div class="box-container">
     <h1>Document Shortcuts</h1>
   </div>
   
   <div class="box-container">
   <table>
    <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
    </tr>
    <tr>
      <td>Home</td>
      <td>Go to the start of line</td>
      <td><div class="btn-s"><a target="_blank" href="ms/HOME.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Home</td>
      <td>Go to the start of document</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+HOME.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Page Down</td>
      <td>Go to next page</td>
      <td><div class="btn-s"><a target="_blank" href="ms/PAGEDOWN.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Page Down</td>
      <td>Go to next page(top)</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+PAGEDOWN.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CRL + F</td>
      <td>Find (Navigation Pane)</td>
      <td><div class="btn-s"><a target="_blank" href="CTRL+F.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Tab</td>
      <td>Go to next table cell</td>
      <td><div class="btn-s"><a target="_blank" href="ms/TAB.gif">View</a></div></td>
    </tr>
    <tr>
      <td>End</td>
      <td>Go to end of line</td>
      <td><div class="btn-s"><a target="_blank" href="ms/END.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + End</td>
      <td>Go to end of document</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+END.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Page Up</td>
      <td>Go to previous page</td>
      <td><div class="btn-s"><a target="_blank" href="ms/pageup.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Ctrl + Page Up</td>
      <td>Go to previous page(top)</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+pageup.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + ALT + T</td>
      <td>Go to a specific Page</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+alt+t.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + ALT + C</td>
      <td>Go to previous table cell</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+alt+c.gif">View</a></div></td>
    </tr>
  </table>
   </div>

   <div class="box-container">
     <h1>Clipboard Shortcuts</h1>
   </div>

   <div class="box-container">
   <table>
    <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
    </tr>
    <tr>
      <td>CTRL + X</td>
      <td>Cut</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+x.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + V</td>
      <td>Paste</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+v.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Copy</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+copy.gif">View</a></div></td>
    </tr>
      <td>CTRL + Alt + V</td>
      <td>Paste Special</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+alt+v.gif">View</a></div></td>
  </table>
   </div>

   <div class="box-container">
     <h1>Paragraph and Pagination Shortcuts</h1>
   </div>

   <div class="box-container">
   <table>
    <tr>
      <th>Shortcut</th>
      <th>Description</th>
      <th>*</th>
    </tr>
    <tr>
      <td>Enter</td>
      <td>New Paragraph</td>
      <td><div class="btn-s"><a target="_blank" href="ms/enter.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Enter</td>
      <td>Paste</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+enter.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Shift + Enter</td>
      <td>Undo last Action</td>
      <td><div class="btn-s"><a target="_blank" href="ms/shift+enter.gif">View</a></div></td>
    </tr>
      <td>CTRL + Shift + Enter</td>
      <td>Paste Special</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+shift+enter.gif">View</a></div></td>
    <tr>
      <td>CTRL + Q</td>
      <td>Paste</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+q.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + M</td>
      <td>Paste</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+m.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Shift + M</td>
      <td>Paste</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+shift+m.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + E</td>
      <td>Paste</td>
      <td><div class="btn-s"><a target="_blank" href="ms/Ctrl+e.gif">View</a></div></td>
    </tr>
  </table>
   </div>

</section>

<!-- about section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>