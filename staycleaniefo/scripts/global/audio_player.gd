extends Node

var current_music_path: String = ""
@onready var player : AudioStreamPlayer
@onready var fx_player := $FxPlayer

#controla el tono y volumen de la musica segun las variables globales
func _process(_delta: float) -> void:
	if Estados.escuela_oscura >= 1:
		player.pitch_scale = 0.9
		if Estados.escuela_oscura == 2:
			player.volume_db = 1.5
		else:
			player.volume_db = 5.0
	else:
		player.pitch_scale = 1.0

#crea un nodo de audio adicional para generar el desvanecido
func _ready():
	player = AudioStreamPlayer.new()
	add_child(player)

func play_music(path: String, fade_duration: float = 1.0):
	if path == current_music_path:
		return #se cancela si la musica ya está sonando
	
	var new_stream = load(path)
	if new_stream:
		# Desvanece la cancion actual
		if player.playing:
			var tween_out = create_tween()
			tween_out.tween_property(player, "volume_db", -80.0, fade_duration)
			await tween_out.finished
		
		# Desvanece la nueva cancion
		player.stream = new_stream
		player.volume_db = -80.0
		player.play()
		current_music_path = path
		
		var tween_in = create_tween()
		tween_in.tween_property(player, "volume_db", 5.0, fade_duration)

#funcion que para la musica, desvaneciendola al llamarse
func stop_music(fade_duration: float = 1.0):
	if player.playing:
		var tween = create_tween()
		tween.tween_property(player, "volume_db", -80.0, fade_duration)
		tween.tween_callback(func(): 
			player.stop()
			player.volume_db = 5.0
			current_music_path = ""
		)

#funcion que activa la musica sin desvanecido
func play_music_og(path: String):
	if path == current_music_path:
		return
	
	var new_stream = load(path)
	if new_stream:
		player.stream = new_stream
		player.play()
		current_music_path = path

#desactiva la musica sin desvanecido
func stop_music_og():
	player.stop()
	current_music_path = ""

#funcion que al llamarse activa sonidos que no sean musica
func play_fx(path: String):
	var fx_stream = load(path)
	if fx_stream:
		fx_player.stream = fx_stream
		fx_player.play()
