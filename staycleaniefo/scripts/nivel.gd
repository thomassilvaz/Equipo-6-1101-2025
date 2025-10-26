extends Node2D

var scene_name: String

func _process(_delta: float) -> void:
	if Estados.escuela_oscura > 0:
		var tween = create_tween()
		tween.tween_property(self, "modulate", Color("#a0c0d0"), 1.0)
	else:
		self.modulate = Color.WHITE
	
	if Estados.escuela_oscura == 2:
		music_player()

func _ready():
	scene_name = get_tree().current_scene.name
	print("Scene loaded: ", scene_name)
	music_player()
	
	if NavegacionManager.spawn_puerta_tag != null:
		_on_level_spawn(NavegacionManager.spawn_puerta_tag)
	else:
		return
	
	match scene_name:
		"piso2":
			if Estados.sustancia1 and !Estados.duda:
				DialogueManager.show_example_dialogue_balloon(load("res://Dialogos/duda.dialogue"))
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
	if get_tree().current_scene == null:
		await get_tree().process_frame
	scene_name = get_tree().current_scene.name
	if Estados.escuela_oscura < 2:
		match scene_name:
			"piso1", "piso2", "salonprincipal", "porteria", "sala_profesores":
				AudioPlayer.play_music("res://Audio/Musica/Tu Escuela.mp3")
			"transicion_boss":
				if Estados.jugador_murio:
					AudioPlayer.play_music("res://Audio/Musica/jugador_muere.mp3")
				elif Estados.redimido:
					AudioPlayer.play_music("res://Audio/Musica/redimido.mp3")
				else:
					AudioPlayer.stop_music()
			_:
				AudioPlayer.stop_music()
	else:
		match scene_name:
			"Arena":
				AudioPlayer.stop_music()
			"transicion_boss":
				if Estados.jugador_murio:
					AudioPlayer.play_music("res://Audio/Musica/jugador_muere.mp3")
				elif Estados.redimido:
					AudioPlayer.play_music("res://Audio/Musica/redimido.mp3")
				else:
					AudioPlayer.stop_music()
			_:
				AudioPlayer.play_music("res://Audio/Musica/Anticipacion.mp3")

func _on_level_spawn(destino_tag: String):
	var puerta_path = "Puertas/Puerta_" + destino_tag
	var puerta = get_node(puerta_path) as Puerta
	if puerta:
		NavegacionManager.trigger_player_spawn(puerta.spawn.global_position, puerta.spawn_direccion)
