<!DOCTYPE html>
<html>
<style>
body {
  font-family: sans-serif;
  font-size: 14px;
  color: #CCC;
  background-color: #000;
  line-height: 20px;
  letter-spacing: 1.25px;
}
a {
  color: green;
}
textarea {
  width: 700px;
  height: 300px;
  margin-bottom: 10px;
  margin-top: 10px;
}

input {
  margin-bottom: 10px;
}
input[type="text"] {
  width: 600px;
}
input[type="submit"] {
  width: 100px;
}

</style>


<head>
  <title>Note Writer</title>
</head>

<body>
  <b>Instructions:</b><br />
  <ul>
    <li>
      To Create a New Note: Write some words, choose what to name your note, hit
      "Save New!"
    </li>
    <li>
      To Add On to a Note: Write some words, copy/paste the filename from the list,
      hit "Add  On!"
    </li>
    <li>
      To Replace the Contents of a Note: Write some words, copy/paste the filename from the list, hit "Replace!"
    </li>
    <li>
      To Delete a File: Copy/paste a filename list, hit "Delete!"
    </li>
    <li>
      Click on a file to view it!
    </li>

  </ul>

  <textarea name="text" placeholder="Note to self... "form="entry"></textarea>
  <form id="entry" action="notewriter.php" method="post">
    <input type="text" name="title" placeholder="Type a new or existing filename" /><br />
    <input type="submit" name="new" value="Save New!" />
    <input type="submit" name="add" value="Add on!" /><br />
    <input type="submit" name="replace" value="Replace!" />
    <input type="submit" name="delete" value="Delete!" />
  </form>

<?php

// If any button is pressed
if ( isset($_POST["add"]) OR isset($_POST["replace"]) OR isset($_POST["delete"]) OR isset($_POST["new"])) {
    // The title and entry variables are saved
  $title = $_POST["title"];
  $entry = $_POST["text"];
  // When the save new button is pressed
  if(isset($_POST["new"])) {
    // As long as the entry is not blank
    if ($entry != "") {
      // Check the title or call it Untitled Note
      if ($title == "") {
        $title = "Untitled_Note.txt";
      } else {
        // Replace any characters that break filenames
        $title = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '_', $title) . ".txt";
      }
      // Open the file (or create it) ,add the entry, close the file
      if (!file_exists($title)) {
        $file = fopen($title,"w");
        fwrite($file,$entry."\r\n ----------\r\n");
        fclose($file);
      } else {
        echo "That file already exists!";
      }
    // If the entry is blank
    } else {
      echo "This note is empty!";
    }
  }

  // When the add on button is pressed
  if(isset($_POST["add"])) {
    if ($title != "") {
      $title = str_replace(".txt","",$title);
      $file = fopen($title . ".txt", "a");
      fwrite($file,$entry."\r\n ----------\r\n");
      fclose($file);
    } else {
      echo "You haven't chosen a filename!";
    }
  }


  // When the replace button is pressed
  if(isset($_POST["replace"])) {
    if ($title != "") {
      $file = fopen($title, "w");
      fwrite($file,$entry."\r\n ----------\r\n");
      fclose($file);
    } else {
      echo "You haven't chosen a filename!";
    }
  }

  // When the delete button is pressed
  if (isset($_POST["delete"])) {
    if ($title != "") {
    // Unlink (delete) the file if it exists
      foreach (glob($title) as $files) {
        unlink($files);
        echo $files . " has been deleted!";
      }

    } else {
      echo "You haven't chosen a filename!";
    }
  }
}

?>

<!-- Displays current text files in the directory -->
<br /><b>Current Notes</b><br />
<?php
foreach (glob("*.txt") as $files) {
  echo "<a href='" . $files . "'>" . $files ."</a><br />";
  }

 ?>

</body>

</html>
