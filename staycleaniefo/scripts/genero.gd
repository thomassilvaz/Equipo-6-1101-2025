extends Control



func _on_hombre_pressed() -> void:
	Estados.nom = "Alex"
	Estados.genero = "o"
	get_tree().change_scene_to_file("res://escenas/menu.tscn")

func _on_mujer_pressed() -> void:
	Estados.nom = "Alexa"
	Estados.genero = "a"
	get_tree().change_scene_to_file("res://escenas/menu.tscn")
