extends Control


func _on_jugar_pressed() -> void:
	get_tree().change_scene_to_file("res://escenas/lugares/porteria.tscn")

func _on_diseño_pressed() -> void:
	get_tree().change_scene_to_file("res://escenas/genero.tscn")

func _on_salir_pressed() -> void:
	get_tree().quit()
