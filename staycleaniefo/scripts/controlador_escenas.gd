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
	
	animation_player.play(nombre_escena)
	await animation_player.animation_finished
	_end_cutscene()

func _end_cutscene():
	is_cutscene_active = false
	cutscene_ended.emit()
	Estados.mark_cutscene_played(cutscene_id)
	queue_free()

func trigger_dialogue(dialogue_resource: DialogueResource):
	animation_player.pause()
	
	DialogueManager.show_example_dialogue_balloon(dialogue_resource)
	await DialogueManager.dialogue_ended
	
	animation_player.play()

func move_character(character_path: NodePath, target_position: Vector3, duration: float):
	var character = get_node(character_path)
	if character and character.has_method("move_in_cutscene"):
		var direction = target_position - character.global_position
		character.move_in_cutscene(direction, duration)
