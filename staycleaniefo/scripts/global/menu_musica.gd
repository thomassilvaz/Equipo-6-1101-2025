extends Node

func _ready() -> void:
	match get_tree().current_scene.name:
		"Menu", "genero":
			AudioPlayer.play_music("res://Audio/Musica/School Remix.mp3")
