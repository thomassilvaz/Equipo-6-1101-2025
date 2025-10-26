extends Control

func _ready() -> void:
	MenuMusica.music_player()


func _on_jugar_pressed() -> void:
	if !Estados.escogio_genero:
		if randi() % 2 == 1:
			Estados.nom = "Alex"
			Estados.genero = "o"
		else:
			Estados.nom = "Alexa"
			Estados.genero = "a"
	EfectoTransicion.transition()
	await EfectoTransicion.on_transition_finished
	get_tree().change_scene_to_file("res://escenas/lugares/porteria.tscn")

func _on_diseño_pressed() -> void:
	get_tree().change_scene_to_file("res://escenas/genero.tscn")

func _on_salir_pressed() -> void:
	EfectoTransicion.transition()
	await EfectoTransicion.on_transition_finished
	get_tree().quit()


func _on_jugar_mouse_entered() -> void:
	AudioPlayer.play_fx("res://Audio/FX/boton_fx.mp3")

func _on_diseño_mouse_entered() -> void:
	AudioPlayer.play_fx("res://Audio/FX/boton_fx.mp3")

func _on_salir_mouse_entered() -> void:
	AudioPlayer.play_fx("res://Audio/FX/boton_fx.mp3")


func _on_redimido_pressed() -> void:
	EfectoTransicion.transition()
	await EfectoTransicion.on_transition_finished
	get_tree().change_scene_to_file("res://escenas/finales/final_neutral.tscn")

func _on_reintentar_pressed() -> void:
	AudioPlayer.stop_music()
	EfectoTransicion.transition()
	await EfectoTransicion.on_transition_finished
	Estados.jugador_murio = false
	Estados.escuela_oscura = 2
	get_tree().change_scene_to_file("res://escenas/lugares/arena.tscn")


func _on_rendirse_pressed() -> void:
	EfectoTransicion.transition()
	await EfectoTransicion.on_transition_finished
	get_tree().change_scene_to_file("res://escenas/finales/final_malo.tscn")
