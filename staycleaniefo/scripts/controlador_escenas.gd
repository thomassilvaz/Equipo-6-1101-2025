extends Node

@export var cutscene_id: String = "intro_cutscene"
@export var animation_player: AnimationPlayer
@export var nombre_escena: String = ""

signal cutscene_started
signal cutscene_ended

var is_cutscene_active: bool = false

func _ready():
	if Estados.has_played_cutscene(cutscene_id):
		return

func start_cutscene():
	if is_cutscene_active:
		return
	
	is_cutscene_active = true
	cutscene_started.emit()
	
	var player = get_tree().get_nodes_in_group("Jugador")
	var jugador = player[0]
	jugador.activar_movimiento(false)
	
	animation_player.play(nombre_escena)
	await animation_player.animation_finished
	_end_cutscene()
	jugador.activar_movimiento(true)

func _end_cutscene():
	is_cutscene_active = false
	cutscene_ended.emit()
	Estados.mark_cutscene_played(cutscene_id)
	#queue_free()

func trigger_dialogue(dialogue_resource: DialogueResource, dialogue_start: String):
	animation_player.pause()
	
	DialogueManager.show_example_dialogue_balloon(dialogue_resource, dialogue_start)
	await DialogueManager.dialogue_ended
	
	animation_player.play()
