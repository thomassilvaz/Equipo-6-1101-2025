extends Node

var scene_name: String

#funcion que al llamarse activa una musica especifica segun el nombre del nodo madre
func music_player():
	if get_tree().current_scene == null:
		await get_tree().process_frame
	scene_name = get_tree().current_scene.name
	match scene_name:
		"Menu", "genero", "Bueno":
			AudioPlayer.play_music_og("res://Audio/Musica/School Remix.mp3")
		"Neutral":
			AudioPlayer.play_music_og("res://Audio/Musica/redimido2.mp3")
		"Malo":
			AudioPlayer.play_music_og("res://Audio/Musica/Anticipacion.mp3")
