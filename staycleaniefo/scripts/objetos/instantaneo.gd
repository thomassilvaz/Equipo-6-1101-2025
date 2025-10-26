extends Node2D

@export var dialogue_resource: DialogueResource
var dialogo_activo = false

#activa dialogo instantaneamente al entrar al area
func _on_area_2d_body_entered(body: Node2D) -> void:
	if body is Jugador and dialogo_activo == false:
		body.activar_movimiento(false)
		
		dialogo_activo = true
		DialogueManager.show_example_dialogue_balloon(dialogue_resource)
		await DialogueManager.dialogue_ended
		dialogo_activo = false
		
		body.activar_movimiento(true)
