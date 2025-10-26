extends Control

#declara las variables usadas para el genero hombre y se regresa al menu
func _on_hombre_pressed() -> void:
	Estados.nom = "Alex"
	Estados.genero = "o"
	Estados.escogio_genero = true
	get_tree().change_scene_to_file("res://escenas/menu.tscn")

#declara las variables usadas para el genero mujer y se regresa al menu
func _on_mujer_pressed() -> void:
	Estados.nom = "Alexa"
	Estados.genero = "a"
	Estados.escogio_genero = true
	get_tree().change_scene_to_file("res://escenas/menu.tscn")

#activa un sonido al detectar el mouse encima
func _on_hombre_focus_entered() -> void:
	AudioPlayer.play_fx("res://Audio/FX/boton_fx.mp3")

#activa un sonido al detectar el mouse encima
func _on_mujer_mouse_entered() -> void:
	AudioPlayer.play_fx("res://Audio/FX/boton_fx.mp3")
