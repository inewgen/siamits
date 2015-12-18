<?php //MyBB ภาษาไทย โดย http://www.chaime.net/forum/forumdisplay.php?fid=12
/**
 * MyBB 1.6 English Language Pack
 * Copyright 2010 MyBB Group, All Rights Reserved
 * 
 * $Id: messages.lang.php 5380 2011-02-21 12:04:43Z Tomm $
 */

$l['click_no_wait'] = "คลิกที่นี่ หากไม่ต้องการรอ";
$l['redirect_return_forum'] = "<br /><br />ทางเลือกอื่น, <a href=\"{1}\">กลับไปยังหน้าแรก</a>";
$l['redirect_emailsent'] = "Your e-mail message has been sent successfully.";
$l['redirect_loggedin'] = "คุณเข้าสู่ระบบเรียบร้อยแล้ว<br />กำลังจะไปยังหน้าที่คุณเข้ามา";

$l['error_invalidpworusername'] = "ชื่อใช้งานและ/หรือรหัสผ่านไม่ถูกต้อง <br /><br />หากคุณลืมรหัสผ่าน กรุณาคลิกเพื่อ <a href=\"member.php?action=lostpw\">ขอรับรหัสผ่านใหม่</a>";
$l['error_incompletefields'] = "It appears you have left one or more required fields blank. Please go back and enter the required fields."; 
$l['error_alreadyuploaded'] = "ข้อความนี้มีไฟล์แนบนี้แล้ว กรุณาตรวจสอบว่าซ้ำกันหรือไม่ หรือเปลี่ยนชื่อไฟล์ก่อนแนบอีกครั้ง";
$l['error_nomessage'] = "Sorry, we cannot proceed because you did not enter a valid message. Please go back and do so.";
$l['error_invalidemail'] = "You did not enter a valid email address.";
$l['error_nomember'] = "The member you specified is either invalid or doesn't exist.";
$l['error_maxposts'] = "I'm sorry, but your daily post limit has been exceeded.  Please wait till tomorrow to post further or contact your administrator.<br /><br />The maximum amount of posts you may make in a day is {1}";
$l['error_nohostname'] = "No hostname could be found for the IP you entered.";
$l['error_invalidthread'] = "ไม่พบกระทู้ที่ระบุ";
$l['error_invalidpost'] = "ไม่พบข้อความที่ระบุ";
$l['error_invalidattachment'] = "ไม่พบไฟล์แนบที่ระบุ";
$l['error_invalidforum'] = "Invalid forum";
$l['error_closedinvalidforum'] = "You may not post in this forum either because the forum is closed, or it is a category.";
$l['error_attachtype'] = "The type of file that you attached is not allowed. Please remove the attachment or choose a different type.";
$l['error_attachsize'] = "The file you attached is too large. The maximum size for that type of file is {1} kilobytes.";
$l['error_uploadsize'] = "The size of the uploaded file is too large.";
$l['error_uploadfailed'] = "The file upload failed. Please choose a valid file and try again. ";
$l['error_uploadfailed_detail'] = "Error details: ";
$l['error_uploadfailed_php1'] = "PHP returned: Uploaded file exceeded upload_max_filesize directive in php.ini.  Please contact your forum administrator with this error.";
$l['error_uploadfailed_php2'] = "The uploaded file exceeded the maximum file size specified.";
$l['error_uploadfailed_php3'] = "The uploaded file was only partially uploaded.";
$l['error_uploadfailed_php4'] = "No file was uploaded.";
$l['error_uploadfailed_php6'] = "PHP returned: Missing a temporary folder.  Please contact your forum administrator with this error.";
$l['error_uploadfailed_php7'] = "PHP returned: Failed to write the file to disk.  Please contact your forum administrator with this error.";
$l['error_uploadfailed_phpx'] = "PHP returned error code: {1}.  Please contact your forum administrator with this error.";
$l['error_uploadfailed_nothingtomove'] = "An invalid file was specified, so the uploaded file could not be moved to its destination.";
$l['error_uploadfailed_movefailed'] = "There was a problem moving the uploaded file to its destination.";
$l['error_uploadfailed_lost'] = "The attachment could not be found on the server.";
$l['error_emailmismatch'] = "The email addresses you entered do not match. Please go back and try again";
$l['error_nopassword'] = "You did not enter a valid password.";
$l['error_usernametaken'] = "The username you have chosen is already registered.";
$l['error_nousername'] = "You did not enter a username.";
$l['error_invalidusername'] = "The username you have entered appears to be invalid.";
$l['error_invalidpassword'] = "The password you entered is incorrect. If you have forgotten your password, click <a href=\"member.php?action=lostpw\">here</a>. Otherwise, go back and try again.";
$l['error_postflooding'] = "We are sorry but we cannot process your post. The administrator has specified you are only allowed to post once every {1} seconds.";
$l['error_nopermission_guest_1'] = "คุณอาจจะยังไม่ได้เข้าสู่ระบบหรือไม่มีสิทธิในการเข้าชมหน้านี้ กรุณาพิจารณาเหตุผลดังด้านล่าง:";
$l['error_nopermission_guest_2'] = "คุณอาจจะยังไม่ได้เข้าสู่ระบบหรือยังไม่ได้ลงทะเบียน กรุณาใช้กล่องเข้าสู่ระบบด้านล่างเพื่อเข้าสู่ระบบก่อนดำเนินการต่อ";
$l['error_nopermission_guest_3'] = "คุณอาจจะไม่ได้รับอนุญาติให้เข้าชมหน้านี้ คุณกำลังพยายามเข้าสู่ส่วนของผู้ดูแลระบบหรือส่วนที่คุณไม่มีสิทธิหรือไม่ กรุณาตรวจสอบกฎของเว็บบอร์ดสำหรับการดำเนินการนี้";
$l['error_nopermission_guest_4'] = "บัญชีสมาชิกของคุณอาจจะถูกระงับโดยผู้ดูแลระบบ หรืออยู่ระหว่างการยืนยันบัญชีสมาชิก";
$l['error_nopermission_guest_5'] = "คุณอาจจะเข้าสู่หน้านี้โดยตรงโดยไม่ผ่านลิงค์ที่ถูกต้องหรือเหมาะสม";
$l['login'] = "เข้าสู่ระบบ";
$l['need_reg'] = "ต้องการลงทะเบียน?";
$l['forgot_password'] = "ลืมรหัสผ่าน?";
$l['error_nopermission_user_1'] = "You do not have permission to access this page. This could be because of one of the following reasons:";
$l['error_nopermission_user_ajax'] = "You do not have permission to access this page.";
$l['error_nopermission_user_2'] = "Your account has either been suspended or you have been banned from accessing this resource.";
$l['error_nopermission_user_3'] = "You do not have permission to access this page. Are you trying to access administrative pages or a resource that you shouldn't be? Check in the forum rules that you are allowed to perform this action.";
$l['error_nopermission_user_4'] = "Your account may still be awaiting activation or moderation.";
$l['error_nopermission_user_5'] = "You have accessed this page directly rather than using appropriate forms or link.";
$l['error_nopermission_user_resendactivation'] = "Resend Activation Code";
$l['error_nopermission_user_username'] = "You are currently logged in with the username: '{1}'";
$l['logged_in_user'] = "Logged In User";
$l['error_too_many_images'] = "Too Many Images.";
$l['error_too_many_images2'] = "We are sorry, but we cannot process your post because it contains too many images. Please remove some images from your post to continue.";
$l['error_too_many_images3'] = "<b>Note:</b> The maximum amount of images per post is";
$l['error_attach_file'] = "Error Attaching File";
$l['please_correct_errors'] = "กรุณาตรวจสอบข้อผิดพลาดเหล่านี้ก่อนดำเนินการต่อ:";
$l['error_reachedattachquota'] = "Sorry but you cannot attach this file because you have reached your attachment quota of {1}";
$l['error_invaliduser'] = "The specified user is invalid or does not exist.";
$l['error_invalidaction'] = "Invalid action";
$l['error_messagelength'] = "ขออภัย ข้อความของคุณมีความยาวมากเกินไป กรุณาลองใหม่อีกครั้งโดยลดความยาวของข้อความลง";
$l['error_message_too_short'] = "ขออภัย ข้อความของคุณสั้นเกินไป ขอให้ลองใหม่อีกครั้ง";
$l['failed_login_wait'] = "การเข้าสู่ระบบผิดพลาดเกินจำนวนครั้งที่กำหนด คุณต้องรออีก {1} ชั่วโมง {2} นาที {3} วินาที จึงจะสามารถเข้าสู่ระบบได้อีกครั้ง";
$l['failed_login_again'] = "<br />คุณเหลืออีก <strong>{1}</strong> ครั้ง สำหรับการเข้าสู่ระบบที่ผิดพลาด";
$l['error_max_emails_day'] = "You cannot use the 'Send Thread to a Friend' or the 'Email User' features because you've already used up your allocated quota of sending {1} messages in the past 24 hours.";
		
$l['emailsubject_lostpw'] = "Password Reset at {1}";
$l['emailsubject_passwordreset'] = "New password at {1}";
$l['emailsubject_subscription'] = "New Reply to {1}";
$l['emailsubject_randompassword'] = "Your Password for {1}";
$l['emailsubject_activateaccount'] = "Account Activation at {1}";
$l['emailsubject_forumsubscription'] = "New Thread in {1}";
$l['emailsubject_reportpost'] = "Reported post at {1}";
$l['emailsubject_reachedpmquota'] = "Private Messaging Quota Reached at {1}";
$l['emailsubject_changeemail'] = "Change of Email at {1}";
$l['emailsubject_newpm'] = "ข้อความส่วนตัวจาก {1}";
$l['emailsubject_sendtofriend'] = "Interesting Web Page at {1}";
$l['emailbit_viewthread'] = "... (visit the thread to read more..)";

$l['email_lostpw'] = "สวัสดีครับคุณ {1}

To complete the phase of resetting your account password at {2}, you will need to go to the URL below in your web browser.

{3}/member.php?action=resetpassword&uid={4}&code={5}

If the above link does not work correctly, go to

{3}/member.php?action=resetpassword

You will need to enter the following:
Username: {1}
Activation Code: {5}

ขอบคุณครับ
ทีมงาน  {2}";


$l['email_reportpost'] = "{1} from {2} has reported this post:

{3}
{4}/{5}

The reason this user gave for reporting this post:
{7}

This message has been sent to all moderators of this forum, or all administrators and super moderators if there are no moderators.

Please check this post out as soon as possible.";

$l['email_passwordreset'] = "สวัสดีครับคุณ {1}

Your password at {2} has been reset.

Your new password is: {3}

You will need this password to login to the forums, once you login you should change it by going to your User Control Panel.

ขอบคุณครับ
ทีมงาน {2}";

$l['email_randompassword'] = "สวัสดีครับคุณ {1}

ขอบคุณสำหรับการลงทะเบียนกับเราที่ {2} ด้านล่างนี้เป็นชื่อใช้งานและรหัสผ่านแบบสุ่มเพื่อเข้าสู่ระบบที่ {2}

ชื่อใช้งาน: {3}
รหัสผ่าน: {4}

เราแนะนำให้คุณเปลี่ยนรหัสผ่านทันทีหลังจากเข้าสู่ระบบ โดยเข้าไปที่ ข้อมูลสมาชิก จากนั้นคลิก เปลี่ยนรหัสผ่าน จากเมนูด้านซ้ายมือ

ขอบคุณครับ
ทีมงาน {2}";

$l['email_sendtofriend'] = "Hello,

{1} from {2} thought you may be interested in reading the following web page:

{3}

{1} included the following message:
------------------------------------------
{4}
------------------------------------------

ขอบคุณครับ
ทีมงาน {2}";

$l['email_forumsubscription'] = "สวัสดีครับคุณ {1}

{2} has just started a new thread in {3}. This is a forum you have subscribed to at {4}.

The thread is titled {5}

Here is an excerpt of the message:
--
{6}
--

To view the thread, you can go to the following URL:
{7}/{8}

There may also be other new threads and replies but you will not receive anymore notifications until you visit the board again.

ขอบคุณครับ
ทีมงาน {4}

------------------------------------------
Unsubscription Information:

If you would not like to receive any more notifications of new threads in this forum, visit the following URL in your browser:
{7}/usercp2.php?action=removesubscription&type=forum&fid={9}&my_post_key={10}

------------------------------------------";

$l['email_activateaccount'] = "สวัสดีครับคุณ {1}

To complete the registration process on {2}, you will need to go to the URL below in your web browser.

{3}/member.php?action=activate&uid={4}&code={5}

If the above link does not work correctly, go to

{3}/member.php?action=activate

You will need to enter the following:
Username: {1}
Activation Code: {5}

ขอบคุณครับ
ทีมงาน {2}";

$l['email_subscription'] = "สวัสดีครับคุณ {1}

{2} has just replied to a thread which you have subscribed to at {3}. This thread is titled {4}.

Here is an excerpt of the message:
------------------------------------------
{5}
------------------------------------------

To view the thread, you can go to the following URL:
{6}/{7}

There may also be other replies to this thread but you will not receive anymore notifications until you visit the board again.

ขอบคุณครับ
ทีมงาน {3}

------------------------------------------
Unsubscription Information:

If you would not like to receive any more notifications of replies to this thread, visit the following URL in your browser:
{6}/usercp2.php?action=removesubscription&tid={8}&key={9}&my_post_key={10}

------------------------------------------";
$l['email_reachedpmquota'] = "สวัสดีครับคุณ {1}

This is an automated email from {2} to let you know that your Private Messaging inbox has reached its capacity.

One or more users may have tried to send you private messages and were unsuccessful in doing so because of this.

Please delete some of your private messages you currently have stored, remembering to also delete them from the 'Trash Can'.

ขอบคุณครับ
ทีมงาน {2}
{3}";
$l['email_changeemail'] = "สวัสดีครับคุณ {1}

We have received a request on {2} to change your email address (see details below).

Old Email Address: {3}
New Email Address: {4}

If these changes are correct, please complete the validation process on {2} by going to the following URL in your web browser.

{5}/member.php?action=activate&uid={8}&code={6}

If the above link does not work correctly, go to

{5}/member.php?action=activate

You will need to enter the following:
Username: {7}
Activation Code: {6}

If you choose not to validate your new email address your profile will not be updated and will still contain your existing email address.

ขอบคุณครับ
ทีมงาน {2}
{5}";

$l['email_newpm'] = "สวัสดีครับคุณ {1}
		
คุณมีข้อความส่วนตัวใหม่จาก {3} ซึ่งส่งถึงคุณโดยคุณ {2} หากต้องการอ่านข้อความดังกล่าวกรุณาคลิกที่ลิงค์ด้านล่างนี้:

{4}/private.php

คุณจะไม่ได้รับการแจ้งเตือนนี้อีกจนกว่าคุณจะเข้าอ่านข้อความนี้ที่ {3}

คุณสามารถยกเลิกการแจ้งเตือนเมื่อมีข้อความส่วนตัวถึงคุณนี้ได้ที่:

{4}/usercp.php?action=options

ขอบคุณครับ
ทีมงาน {3}
{4}";

$l['email_emailuser'] = "สวัสดีครับคุณ {1}

{2} from {3} has sent you the following message:
------------------------------------------
{5}
------------------------------------------

ขอบคุณครับ
ทีมงาน {3}
{4}

------------------------------------------
Don't want to receive email messages from other members?

If you don't want other members to be able to email you please visit your User Control Panel and enable the option 'Hide your email from other members':
{4}/usercp.php?action=options

------------------------------------------";
?>