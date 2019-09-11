<?php
// SPDX-License-Identifier: BSD-3-Clause

//////////////////////////////////////////////////////////////////////////////
// Security
//
// include calls are based on static variables.
//
// No other filesystem calls take place in this view.  See
// functions.php/directory_data() for directory listing validation.
//

///////////////////////////////////////////////////////////////////////////////
// list view
//   $INDEX -> page N of listings, based on $CFG_max_thumbs
//

// fetch directory listing
//
$data = directory_data($PATH, "$IMAGE_DIR$IMAGE_FILE"); // FS SEE FUNCTION

// create pagination data
//
$total_images = sizeof($data['files']);
$offset       = $INDEX;
$offset_prev  = -1;
$offset_next  = -1;

if ($offset > $total_images - 1 || $offset < 0) $offset = 0;
if ($offset > 0 && $CFG_images_per_page != 0) $offset_prev = max(0, $offset - $CFG_images_per_page);
if ($offset < $total_images - $CFG_images_per_page && $CFG_images_per_page != 0) $offset_next = min($total_images - 1, $offset + $CFG_images_per_page);

//////////////////////////////////////////////////////////////////////////////
// assign, display templates
//
if ($CFG_images_per_page) {
  $T['files'] = array_slice($data['files'], $offset, $CFG_images_per_page);
} else {
  $T['files'] = $data['files'];
} // if
$T['dirs']            = $data['directories'];
$T['path']            = path_list($IMAGE_DIR);
$T['offset']          = $offset;
$T['offset_prev']     = $offset_prev;
$T['offset_next']     = $offset_next;
$T['offset_prev_url'] = build_url('list', $offset_prev, $IMAGE_DIR);
$T['offset_next_url'] = build_url('list', $offset_next, $IMAGE_DIR);
debug('T', $T);

include("$CFG_path_template/header.tpl"); // FS READ
include("$CFG_path_template/list.tpl");   // FS READ
include("$CFG_path_template/footer.tpl"); // FS READ

?>
