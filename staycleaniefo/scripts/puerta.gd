extends Area2D

class_name Puerta

@export var destino_nivel_tag: String
@export var destino_puerta_tag: String
@export var spawn_direccion = "abajo"

@onready var spawn = $Spawn


func _on_body_entered(body):
	if body is Jugador:
		NavegacionManager.go_to_level(destino_nivel_tag, destino_puerta_tag)
