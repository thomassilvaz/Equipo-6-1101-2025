extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

var jugador_cerca := false

func _ready():
	if get_tree().current_scene.name == "bathroom1":	
		if Estados.vendedor_bath1 == true:
			show()
			colision.disabled = false
			interactuable.disabled = false
		else:
			hide()
			colision.disabled = true
			interactuable.disabled = true
	elif get_tree().current_scene.name == "piso1":
		colision.disabled = false
		interactuable.disabled = false
		
func _on_interactuable_body_entered(body: Node2D) -> void:
	if body is Jugador:
		jugador_cerca = true

func _on_interactuable_body_exited(body: Node2D) -> void:
	if body is Jugador:
		jugador_cerca = false
