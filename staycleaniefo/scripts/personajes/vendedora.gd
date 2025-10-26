extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

#funcion que al llamarse activa una animacion del sprite manualmente
func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

#determina la posicion del personaje segun la escena y las condiciones activas
func _ready():
	match get_tree().current_scene.name:
		"piso1":
			if Estados.introduccion:
				if Estados.decision_2 == "mala" and Estados.escena_divergente1:
					global_position = Vector2(1462, 2237)
				else:
					global_position = Vector2(28, -719)
			else:
				global_position = Vector2(838, -103)
		"piso2":
			if Estados.decision3_tomada:
				if Estados.escena_divergente1:
					global_position = Vector2(28, -2000)
				else:
					global_position = Vector2(2324, 75)
			else:
				global_position = Vector2(28, -2000)

#reactiva el dialogo del personaje
func activar_dialogo():
	interactuable.set_deferred("disabled", false)
