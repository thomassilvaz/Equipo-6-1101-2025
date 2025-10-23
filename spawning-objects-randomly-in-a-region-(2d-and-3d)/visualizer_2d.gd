extends Control

var parent: Node

func _ready():
	parent = get_parent()

func _draw():
	var region_rect: Rect2
	region_rect.position = parent.point_1
	region_rect.end = parent.point_2
	
	draw_rect(region_rect, Color.RED,false,1.0 )
	draw_circle(parent.point_1, 5.0, Color.RED, true)
	draw_circle(parent.point_2, 5.0, Color.RED, true)
	draw_string(ThemeDB.fallback_font, parent.point_1 + Vector2(10,20), "point 1", HORIZONTAL_ALIGNMENT_LEFT, -1, ThemeDB.fallback_font_size)
	draw_string(ThemeDB.fallback_font, parent.point_2 - Vector2(60,15), "point 2", HORIZONTAL_ALIGNMENT_LEFT, -1, ThemeDB.fallback_font_size)

func _process(_delta):
	queue_redraw()
