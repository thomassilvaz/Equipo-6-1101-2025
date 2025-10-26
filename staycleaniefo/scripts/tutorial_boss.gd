extends VBoxContainer

#elimina el nodo que explica los controles de ataque en la arena del Boss
func _ready() -> void:
	await get_tree().create_timer(10.0).timeout
	queue_free()
