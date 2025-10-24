extends Node2D

@onready var Karen = $Karen
@onready var Julian = $Julián
@onready var Mateo = $Mateo
@onready var Ronald = $Ronald
@onready var Valeria = $Valeria
@onready var Laura = $PsicólogaLaura
@onready var Muerte = $Muerte

@onready var animation_player = $AnimationPlayer 

func _ready() -> void:
	if Estados.jugador_murio:
		Estados.escuela_oscura = 0
		AudioPlayer.play_music("res://Audio/Musica/jugador_muere.mp3")
		if Estados.murio_repetido:
			animation_player.play("reintentar")
		else:
			animation_player.play("muerto")
	elif Estados.redimido:
		Estados.escuela_oscura = 0
		AudioPlayer.play_music(["res://Audio/Musica/redimido.mp3", "res://Audio/Musica/redimido2.mp3"][randi() % 2])
		animation_player.play("redimido")
	else:
		AudioPlayer.stop_music()
		animation_player.play("bienvenida_boss")
		await animation_player.animation_finished
		get_tree().change_scene_to_file("res://escenas/lugares/arena.tscn")

func trigger_dialogue(dialogue_resource: DialogueResource):
	animation_player.pause()
	
	DialogueManager.show_example_dialogue_balloon(dialogue_resource)
	await DialogueManager.dialogue_ended
	
	animation_player.play()
