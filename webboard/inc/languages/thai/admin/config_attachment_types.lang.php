<?php //MyBB ภาษาไทย โดย http://www.chaime.net/forum/forumdisplay.php?fid=12
/**
 * MyBB 1.6 English Language Pack
 * Copyright Œ 2010 MyBB Group, All Rights Reserved
 * 
 * $Id: config_attachment_types.lang.php 5297 2010-12-28 22:01:14Z Tomm $
 */

$l['attachment_types'] = "Attachment Types";
$l['attachment_types_desc'] = "Here you can create and manage attachment types which define which types of files users can attach to posts.";
$l['add_new_attachment_type'] = "Add New Attachment Type";
$l['add_attachment_type'] = "Add Attachment Type";
$l['add_attachment_type_desc'] = "Adding a new attachment type will allow members to attach files of this type to their posts. You have the ability to control the extension, MIME type, maximum size and show a small icon for each attachment type.";
$l['edit_attachment_type'] = "Edit Attachment Type";
$l['edit_attachment_type_desc'] = "You have the ability to control the extension, MIME type, maximum size and show a small MIME type for this attachment type.";

$l['extension'] = "Extension";
$l['maximum_size'] = "Maximum Size";
$l['no_attachment_types'] = "There are no attachment types on your forum at this time.";

$l['file_extension'] = "File Extension";
$l['file_extension_desc'] = "Enter the file extension you wish to allow uploads for here (Do not include the period before the extension) (Example: txt)";
$l['mime_type'] = "MIME Type";
$l['mime_type_desc'] = "Enter the MIME type sent by the server when downloading files of this type (<a href=\"http://www.webmaster-toolkit.com/mime-types.shtml\">See a list here</a>)";
$l['maximum_file_size'] = "Maximum File Size (Kilobytes)";
$l['maximum_file_size_desc'] = "The maximum file size for uploads of this attachment type in Kilobytes (1 MB = 1024 KB)";
$l['limit_intro'] = "Please ensure the maximum file size is below the smallest of the following PHP limits:";
$l['limit_post_max_size'] = "Max Post Size: {1}";
$l['limit_upload_max_filesize'] = "Upload Max File Size: {1}";
$l['attachment_icon'] = "Attachment Icon";
$l['attachment_icon_desc'] = "If you wish to show a small attachment icon for attachments of this type then enter the path to it here. {theme} will be replaced by the image directory for the viewers theme allowing you to specify per-theme attachment icons.";
$l['save_attachment_type'] = "Save Attachment Type";

$l['error_invalid_attachment_type'] = "You have selected an invalid attachment type.";
$l['error_missing_mime_type'] = "You did not enter a MIME type for this attachment type";
$l['error_missing_extension'] = "You did not enter a file extension for this attachment type";

$l['success_attachment_type_created'] = "The attachment type has been created successfully.";
$l['success_attachment_type_updated'] = "The attachment type has been updated successfully.";
$l['success_attachment_type_deleted'] = "The attachment type has been deleted successfully.";

$l['confirm_attachment_type_deletion'] = "Are you sure you wish to delete this attachment type?";

?>