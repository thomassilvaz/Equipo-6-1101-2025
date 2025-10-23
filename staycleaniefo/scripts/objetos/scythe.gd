extends Node2D

@export var clockwise: bool = true
@export var velocidad: float = 444.0
var direccion: Vector2 = Vector2.RIGHT
var rotacion: float = 120.0

func _process(delta):
	position += direccion * velocidad * delta
	var direction = 1 if clockwise else -1
	rotation_degrees += rotacion * direction * delta
	await get_tree().create_timer(15.0).timeout
	queue_free()
