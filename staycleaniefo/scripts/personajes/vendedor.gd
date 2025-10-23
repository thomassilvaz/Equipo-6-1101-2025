extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

var jugador_cerca := false

func _ready():
	match get_tree().current_scene.name:
		"piso1":
			if Estados.introduccion:
				if Estados.decision_2 == "mala" and Estados.escena_divergente1:
					global_position = Vector2(1355, 2217)
				else:
					global_position = Vector2(28, -719)
			else:
				global_position = Vector2(770, -55)
				#$Interactuable.dialogue_start = "oferta1"
		"piso2":
			if Estados.decision3_tomada:
				if Estados.escena_divergente1:
					global_position = Vector2(28, -719)
				else:
					global_position = Vector2(2323, -30)
					print("Vendedor está esperando afuera del salón")
			else:
				global_position = Vector2(1991, 183)
				print("Vendedor está listo para decision 2")
	
	#visibilidad_npc(mostrar)

func visibilidad_npc(visibilidad: bool):
	if visibilidad:
		show()
		colision.disabled = false
		interactuable.disabled = false
	else:
		hide()
		colision.disabled = true
		interactuable.disabled = true

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)
		
func _on_interactuable_body_entered(body: Node2D) -> void:
	if body is Jugador:
		jugador_cerca = true

func _on_interactuable_body_exited(body: Node2D) -> void:
	if body is Jugador:
		jugador_cerca = false
