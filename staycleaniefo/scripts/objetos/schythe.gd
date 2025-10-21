extends Node2D

@export var clockwise: bool = true
@export var velocidad: float = 200.0
var direccion: Vector2 = Vector2.RIGHT
var rotacion: float = 90.0

func _process(delta):
	position += direccion * velocidad * delta
	var direction = 1 if clockwise else -1
	rotation_degrees += rotacion * direction * delta
