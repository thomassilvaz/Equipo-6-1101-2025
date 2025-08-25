extends Node

func _ready():
	var scene_name = get_tree().current_scene.name
	print("Scene loaded: ", scene_name)

	match scene_name:
		"piso1", "piso2", "salonprincipal", "salon2_p1", "porteria":
			AudioPlayer.play_music("res://Audio/Musica/Tu Escuela.mp3")
		#"salon":
			#AudioPlayer.play_music("res://music/salon_theme.ogg")
		"bathroom1":
			AudioPlayer.stop_music()
		_:
			AudioPlayer.stop_music()
	
	if NavegacionManager.spawn_puerta_tag != null:
		_on_level_spawn(NavegacionManager.spawn_puerta_tag)
		
		
func _on_level_spawn(destino_tag: String):
	var puerta_path = "Puertas/Puerta_" + destino_tag
	var puerta = get_node(puerta_path) as Puerta
	NavegacionManager.trigger_player_spawn(puerta.spawn.global_position, puerta.spawn_direccion)
