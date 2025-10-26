extends Area2D

@export var dialogue_resource: DialogueResource
@export var dialogue_start: String = "start"

#activa dialogo al ser llamado unicamente
func action():
	DialogueManager.show_example_dialogue_balloon(dialogue_resource, dialogue_start)
	await DialogueManager.get_next_dialogue_line(dialogue_resource, dialogue_start)
