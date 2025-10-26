extends CharacterBody2D

@onready var interactuable = $Interactuable/CollisionShape2D

#funcion que al llamarse activa una animacion del sprite manualmente
func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

#funcion que al llamarse activa una animacion de su animationplayer
func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

#determina la posicion del personaje segun la escena y las condiciones activas
func _ready():
	match get_tree().current_scene.name:
		"piso1":
			if Estados.decision_2 == "mala" and Estados.escena_divergente1:
				global_position = Vector2(1574, 2203)
			else:
				global_position = Vector2(-205, -644)
		"piso2":
			if !Estados.decision2_tomada:
				global_position = Vector2(2016, -41)
