extends Node

func _ready() -> void:
	if get_tree().current_scene.name == "menu" or "genero":
		AudioPlayer.play_music("res://Audio/Musica/School Remix.mp3")
