<?php
//Checks if format/input is valid
function validName($name, $text){
    if($name === "" || $name != htmlspecialchars($name) || !ctype_alpha($name)){
        echo "<p>$text: Invalid Input must only have letters</p>";
        return false;
    }
    else{
        echo "<p>$text: $name</p>";
    }
}

//checks if format/input is valid
function validMail($eMail, $addToMail){
    if(!empty($eMail) || $addToMail !== ""){
        if(trim($eMail) === "" || $eMail !== htmlspecialchars($eMail) ||
            !filter_var($eMail, FILTER_VALIDATE_EMAIL)){

            echo "<p>Email: Invalid Email Format, Example: example@mail.net</p>";
            return false;
        }
        else{
            echo "<p>Email: $eMail</p>";
        }
    }
}

//Checks if link is valid
function validLink($link){
    if($link !== htmlspecialchars($link) ||
        preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link) !== 1){

        echo "<p>Invalid URL</p>";
        return false;
    }
    else{
        echo "URL: $link";
    }
}

//Checks if How we met is Choosen
function validMeetType($array, $meetType, $other){
    if(in_array($meetType,$array)){
        echo "<p>Meet Type: $meetType</p>";
    }
    elseif($meetType === "other" && $other === htmlspecialchars($other) && trim($other) !== ""){
        echo "<p>How We Met: ".$other."</p>";
    }
    else{
        echo "<p>Meet Type: Invalid Meet Type</p>";
        return false;
    }
}

//create insert into database for person
function insertPerson($cnxn, $firstName, $lastName, $meetType, $currDate){
    $sql = "INSERT INTO `person`(first_name, last_name, meet_type, join_date) VALUES ('$firstName','$lastName','$meetType','$currDate')";

    return mysqli_query($cnxn, $sql);
}

//create insert into database for person
function insertGuest($cnxn, $personId, $company, $jobTittle, $link, $comments, $mailList, $email){
    $sql = "INSERT INTO `guest_book`(`person_id`, `company`, `job_tittle`, `link_url`, `comments`, `mail_list`, `email`) 
            VALUES ('$personId','$company','$jobTittle','$link','$comments','$mailList','$email')";

    return mysqli_query($cnxn, $sql);
}

//Inserts all the information provided into the database
function saveToGuestBook($cnxn, $firstName, $lastName, $meetType,
                         $company, $jobTittle, $link, $comments, $mailList, $email){
    $currDate = date('Y-m-d');
    $insertPerson = insertPerson($cnxn, $firstName, $lastName, $meetType, $currDate);

    if($insertPerson){
        $personID = $cnxn->insert_id;
        $insertGuest = insertGuest($cnxn, $personID, $company, $jobTittle, $link,$comments, $mailList, $email);

        if($insertGuest){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }

}