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

      <div class="box active word-box">
         
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
    

<div id="word-content" style="display: block;">
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
  </div>

<div id="excel-content" style="display: none;">

  <div class="box-container">
     <h1>Clipboard Shortcuts</h1>
  </div>

   <br><br>
   
   <div class="box-container">
  <table>
  <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
  </tr>

   <tr>
      <td>CTRL + N</td>
      <td>Create a new workbook.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+N.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + O</td>
      <td>Open an existing workbook</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+O.gif">View</a></div></td>
    </tr>
    <tr>
      <td>F12</td>
      <td>Save the active workbook under a new name, displays the Save as dialog box</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/F12.gif">View</a></div></td>
    </tr>
      <td>CTRL + W</td>
      <td>Close the active workbook</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+W.gif">View</a></div></td>
    <tr>
      <td>CTRL + C</td>
      <td>Copy the contents of the selected cells to Clipboard</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+C.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + X</td>
      <td>Cut the contents of the selected cells to Clipboard</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+N.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + V</td>
      <td>Insert the contents of the Clipboard into the selected cell(s)</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+V.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Z</td>
      <td>Undo your last action</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Z.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + P</td>
      <td>Open the "Print" dialog.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+P.gif">View</a></div></td>
    </tr>

  </table>
  </div>

  <div class="box-container">
     <h1>Formatting Data</h1>
  </div>

  <div class="box-container">
  <table>
  <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
  </tr>
    <tr>
      <td>CTRL + 1</td>
      <td>Open the "Format Cells" dialog.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+1.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + T</td>
      <td>Convert selected cells to a table. You can also select any cell in a range of related data, and pressing Ctrl + T will make it a table.t</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+T.gif" >View</a></div></td>
    </tr>
  </table>
  </div>

  <div class="box-container">
     <h1>Working with formulas</h1>
  </div>

  <div class="box-container">
  <table>
  <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
  </tr>
  <tr>
      <td>Tab</td>
      <td>Autocomplete the function name. Example: Enter = and start typing vl, press Tab and you will get =vlookup(</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/tab.gif">View</a></div></td>
    </tr>
    <tr>
      <td>F4</td>
      <td>Cycle through various combinations of formula reference types. Place the cursor within a cell and hit F4 to get the needed reference type: 
        absolute, relative or mixed (relative column and absolute row, absolute column and relative row)Cycle through various combinations of formula reference types. Place the cursor within a cell and hit F4 to get the needed reference type: absolute, relative or mixed (relative column and absolute row, absolute column and relative row)</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/F4.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CtRL + `</td>
      <td>Find (Navigation Pane)</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+`.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + '</td>
      <td>Go to next table cell</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+'.gif">View</a></div></td>
    </tr>
    </table>
  </div>

  <div class="box-container">
    <h1>Navigating and Viewing data</h1>
  </div>

  <div class="box-container">
    <table>
      <tr class="first">
        <th>Shortcut</th>
        <th>Description</th>
        <th class="last">*</th>
      </tr>
    <tr>
      <td>CTRL + F1</td>
      <td>Show / hide the Excel Ribbon. Hide the ribbon to view more than 4 rows of data.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+F1.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Tab</td>
      <td>Switch to the next worksheet. Press Ctrl + PgUp to switch to the previous sheet.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Tab.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Page Down</td>
      <td>Go to previous page</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Pagedown.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Ctrl + G</td>
      <td>Open the "Go to" dialog. Pressing F5 displays the same dialog.)</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+G.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + F</td>
      <td>Display the "Find" dialog box.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+F.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Home</td>
      <td>Return to the 1st cell of the current row in a worksheet.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/Home.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Home</td>
      <td>Move to the beginning of a worksheet (A1 cell).</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Home.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + End</td>
      <td>Move to the last used cell of the current worksheet, i.e. the lowest row of the rightmost column.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+End.gif">View</a></div></td>
    </tr>
  </table>
  </div>

  <div class="box-container">
     <h1>Entering Data</h1>
  </div>

  <div class="box-container">
  <table>
  <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
  </tr>
  <tr>
      <td>F2</td>
      <td>Edit the current cell.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/F2.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Alt + Enter</td>
      <td>	In cell editing mode, enter a new line (carriage return) into a cell.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/Alt+Enter.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + ;</td>
      <td>Enter the current date. Press Ctrl + Shift + ; to enter the current time.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+;.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Enter</td>
      <td>Fill the selected cells with the contents of the current cell.<br>
        Example: select several cells. Press and hold down Ctrl, click on any cell within 
        selection and press F2 to edit it. Then hit Ctrl + Enter and the contents of the 
        edited cell will be copied into all selected cells.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Enter.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + D</td>
      <td>Copy the contents and format of the first cell in the selected range into the 
        cells below. If more than one column is selected, the contents of the topmost 
        cell in each column will be copied downwards.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+D.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Shift + V</td>
      <td>Open the "Paste Special" dialog when clipboard is not empty.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Shift+V.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Y</td>
      <td>Repeat / Redo the last action, if possible.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Y.gif">View</a></div></td>
    </tr>
  </table>
  </div>

  <div class="box-container">
  <h1>Selecting data</h1>
  </div>

  <div class="box-container">
  <table>
    <tr class="first">
      <th>Shortcut</th>
      <th>Description</th>
      <th class="last">*</th>
  </tr>
    <tr>
      <td>Ctrl + A</td>
      <td>Select the entire worksheet. If the cursor is currently placed within a table, 
        press once to select the table, press one more time to select the whole worksheet.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+A.gif">View</a></div></td>
    </tr>
    <tr>
      <td>CTRL + Home then Ctrl + Shift + End</td>
      <td>Select the entire range of your actual used data on the current worksheet.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Home.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Ctrl + Space</td>
      <td>Select the entire column.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/CTRL+Space.gif">View</a></div></td>
    </tr>
    <tr>
      <td>Shift + Space</td>
      <td>Select the entire row.</td>
      <td><div class="btn-s"><a target="_blank" href="EXCEL/Shift+Space.gif">View</a></div></td>
    </tr>
  </table>
  </div>




  </div>



</section>

<!-- about section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>