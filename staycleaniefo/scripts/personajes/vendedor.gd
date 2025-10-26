extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

#funcion que al llamarse activa una animacion del sprite manualmente
func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

var jugador_cerca := false

#determina la posicion del personaje segun la escena y las condiciones activas
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

#funcion que al llamarse determina si activar o desactivar por completo el personaje
func visibilidad_npc(visibilidad: bool):
	if visibilidad:
		show()
		colision.disabled = false
		interactuable.disabled = false
	else:
		hide()
		colision.disabled = true
		interactuable.disabled = true

#deja al jugador interactuar con el npc al entrar al area
func _on_interactuable_body_entered(body: Node2D) -> void:
	if body is Jugador:
		jugador_cerca = true

#ya no le deje interactuar
func _on_interactuable_body_exited(body: Node2D) -> void:
	if body is Jugador:
		jugador_cerca = false
