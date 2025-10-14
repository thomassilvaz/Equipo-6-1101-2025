extends Node2D

func _process(_delta: float) -> void:
	if Estados.escuela_oscura:
		create_tween().tween_property(self, "modulate", Color("#c4d9e4"), 1.0)
	else:
		create_tween().tween_property(self, "modulate", Color("#ffffff"), 1.0)

func _ready():
	var scene_name = get_tree().current_scene.name
	print("Scene loaded: ", scene_name)
	music_player()
	
	if NavegacionManager.spawn_puerta_tag != null:
		_on_level_spawn(NavegacionManager.spawn_puerta_tag)
	else:
		return
	
	match scene_name:
		"salon2_p1":
			if Estados.decision3_tomada:
				if Estados.decision_3 == "buena":
					NavegacionManager.trigger_player_spawn(Vector2(160,22), "abajo")
		"bathroom1":
			if Estados.decision3_tomada:
				if Estados.decision_3 == "mala":
					NavegacionManager.trigger_player_spawn(Vector2(-63,-34), "arriba")
		"bathroom2":
			if Estados.decision3_tomada:
				if Estados.decision_3 == "mala":
					NavegacionManager.trigger_player_spawn(Vector2(-63,-34), "arriba")

func music_player():
	var scene_name = get_tree().current_scene.name
	match scene_name:
		"piso1", "piso2", "salonprincipal", "porteria", "sala_profesores":
			AudioPlayer.play_music("res://Audio/Musica/Tu Escuela.mp3")
		#"salon":
			#AudioPlayer.play_music("res://music/salon_theme.ogg")
		"bathroom1":
			AudioPlayer.stop_music()
		_:
			AudioPlayer.stop_music()

func _on_level_spawn(destino_tag: String):
	var puerta_path = "Puertas/Puerta_" + destino_tag
	var puerta = get_node(puerta_path) as Puerta
	if puerta:
		NavegacionManager.trigger_player_spawn(puerta.spawn.global_position, puerta.spawn_direccion)
