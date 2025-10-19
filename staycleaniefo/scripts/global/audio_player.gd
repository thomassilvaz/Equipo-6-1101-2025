extends Node

var current_music_path: String = ""
@onready var player := $MusicPlayer
@onready var fx_player := $FxPlayer

func _process(_delta: float) -> void:
	if Estados.escuela_oscura >= 1:
		player.pitch_scale = 0.9
		if Estados.escuela_oscura == 2:
			player.volume_db = 1.5
		else:
			player.volume_db = 5.0
	else:
		player.pitch_scale = 1.0

func play_music(path: String):
	if path == current_music_path:
		return
	
	var new_stream = load(path)
	if new_stream:
		player.stream = new_stream
		player.play()
		current_music_path = path

func stop_music():
	player.stop()
	current_music_path = ""

func play_fx(path: String):
	var fx_stream = load(path)
	if fx_stream:
		fx_player.stream = fx_stream
		fx_player.play()
