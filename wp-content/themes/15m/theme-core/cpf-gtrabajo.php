<?php 

//definir la caja 
function set_box_gtrabajo () {
	add_meta_box(
		"gtrabajo", 
		"Información del Grupo de Trabajo", 	
		"show_box_gtrabajo", 
		"post", 
		"normal", 
		"high");
}

//poner la caja (luego la escondemos y jugamos con ella con js)
add_action("add_meta_boxes", "set_box_gtrabajo");

$prefix = "gtrabajo-";
$gtrabajo_post_fields = array (
	array (
		"title"    => "Nombre",
		"id"       => $prefix . "nombre",
		"desc"     => "Mete el nombre del grupo",
		"type"     => "text"
	),
	array (
		"title"    => "Fecha",
		"id"       => $prefix . "fecha",
		"desc"     => "Mete la fecha",
		"type"     => "text"
	),
	array (
		"title"    => "Hora",
		"id"       => $prefix . "hora",
		"desc" => "Mete la hora",
		"type" => "text"
	),
	array (
		"title" => "Lugar",
		"id" => $prefix . "lugar",
		"desc" => "Mete lugar",
		"type" => "text"
	),
	array (
		"title" => "Mapa",
		"id"    => $prefix . "mapa",
		"desc"  => "Objeto googlemaps",
		"type"  => "text"
	),
	array (
		"title" => "Mapa-x",
		"id"    => $prefix . "mapa-x",
		"type"	=> "hidden"
	),
	array (
		"title" => "Mapa-y",
		"id"    => $prefix . "mapa-y",
		"type"	=> "hidden"
	)
);



function show_box_gtrabajo () {
	global $gtrabajo_post_fields, $post;
	
	echo '<input type="hidden" id="' . $gtrabajo_post_fields[5]["id"] . '" value="'. get_post_meta($post->ID, $gtrabajo_post_fields[5]["id"], true) .'" name="' . $gtrabajo_post_fields[5]["id"] . '">';
	echo '<input type="hidden" id="' . $gtrabajo_post_fields[6]["id"] . '" value="'. get_post_meta($post->ID, $gtrabajo_post_fields[6]["id"], true) .'" name="' . $gtrabajo_post_fields[6]["id"] . '">';
	echo '<table style="border:1px solid #ddd; position:relative; overflow:hidden;" class="form-table">
		<tr>
			<th>
				<label for="'. $gtrabajo_post_fields[0]["id"] .'">'. $gtrabajo_post_fields[0]["title"] .'</label>
			</th>
			<td>
				<input type="'. $gtrabajo_post_fields[0]["type"] .'" id="'. $gtrabajo_post_fields[0]["id"] .'" value="'. get_post_meta($post->ID, $gtrabajo_post_fields[0]["id"], true) .'" name="'. $gtrabajo_post_fields[0]["id"] .'"/>
				<br/><span class="description">'. $gtrabajo_post_fields[0]["desc"] .'</span>
			</td>
			<td width="400" height="218" rowspan="4" >
				<div id="map-canvas-gtrabajo" style="width:100%; height:100%" data-map="' . get_post_meta($post->ID, $gtrabajo_post_fields[4]["id"],true) . '"> </div>
			</td>
		</tr>
		<tr>
			<th>
				<label for="'. $gtrabajo_post_fields[1]["id"] .'">'. $gtrabajo_post_fields[1]["title"] .'</label>
			</th>
			<td>
				<input type="'. $gtrabajo_post_fields[1]["type"] .'" id="'. $gtrabajo_post_fields[1]["id"] .'" value="'. get_post_meta($post->ID, $gtrabajo_post_fields[1]["id"], true) .'" name="'. $gtrabajo_post_fields[1]["id"] .'"/>
				<br/><span class="description">'. $gtrabajo_post_fields[1]["desc"] .'</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="'. $gtrabajo_post_fields[2]["id"] .'">'. $gtrabajo_post_fields[2]["title"] .'</label>
			</th>
			<td>
				<input type="'. $gtrabajo_post_fields[2]["type"] .'" id="'. $gtrabajo_post_fields[2]["id"] .'" value="'. get_post_meta($post->ID, $gtrabajo_post_fields[2]["id"], true) .'" name="'. $gtrabajo_post_fields[2]["id"] .'"/>
				<br/><span class="description">'. $gtrabajo_post_fields[2]["desc"] .'</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="'. $gtrabajo_post_fields[3]["id"] .'">'. $gtrabajo_post_fields[3]["title"] .'</label>
			</th>
			<td>
				<input type="'. $gtrabajo_post_fields[3]["type"] .'" id="'. $gtrabajo_post_fields[3]["id"] .'" value="'. get_post_meta($post->ID, $gtrabajo_post_fields[3]["id"], true) .'" name="'. $gtrabajo_post_fields[3]["id"] .'"/>
				<br/><span class="description">'. $gtrabajo_post_fields[3]["desc"] .'</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="'. $gtrabajo_post_fields[4]["id"] .'">'. $gtrabajo_post_fields[4]["title"] .'</label>
			</th>
			<td>
				<input type="'. $gtrabajo_post_fields[4]["type"] .'" id="'. $gtrabajo_post_fields[4]["id"] .'" value="'. get_post_meta($post->ID, $gtrabajo_post_fields[4]["id"], true) .'" name="'. $gtrabajo_post_fields[4]["id"] .'"/>
				<br/><span class="description">'. $gtrabajo_post_fields[4]["desc"] .'</span>
			</td>
		</tr>
	</table>';
}

function save_box_gtrabajo ($post_id) {
	global $gtrabajo_post_fields;
	
//mierda de permisos y seguridad    
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
	return $post_id;  
	
if ('page' == $_POST['post_type']) {  
	if (!current_user_can('edit_page', $post_id))  
		return $post_id;  
	} elseif (!current_user_can('edit_post', $post_id)) {  
		return $post_id;  
}  
      
// loop through fields and save the data  
for ($i = 0; $i < count($gtrabajo_post_fields); $i++) {  
	$old = get_post_meta($post_id, $gtrabajo_post_fields[$i]['id'], true);  
	$new = $_POST[$gtrabajo_post_fields[$i]['id']];  
	if ($new && $new != $old) {  
		update_post_meta($post_id, $gtrabajo_post_fields[$i]['id'], $new);  
	} elseif ('' == $new && $old) {  
		delete_post_meta($post_id, $gtrabajo_post_fields[$i]['id'], $old);  
	}  
} 
}// end foreach  
add_action('save_post', 'save_box_gtrabajo'); 
?>