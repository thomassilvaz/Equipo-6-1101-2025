extends Node3D

#This node draws the rectangular region for the demo project. This is for demonstration purposes only, so you can see the region that powerups will spawn in. Credit to Acert Gaming on YouTube, whose tutorial I followed to create this visualizer.

var point_1: Vector3
var point_2: Vector3


func draw_line(start: Vector3, end: Vector3, color = Color.RED):
	var mesh_instance := MeshInstance3D.new()
	var immediate_mesh := ImmediateMesh.new()
	var material := ORMMaterial3D.new()
	
	mesh_instance.mesh = immediate_mesh
	mesh_instance.cast_shadow = 0
	
	immediate_mesh.surface_begin(Mesh.PRIMITIVE_LINES, material)
	immediate_mesh.surface_add_vertex(start)
	immediate_mesh.surface_add_vertex(end)
	immediate_mesh.surface_end()
	
	material.shading_mode = BaseMaterial3D.SHADING_MODE_UNSHADED
	material.albedo_color = color
	
	add_child(mesh_instance)


func draw_region(): 
	#defines the 8 points on the rectangular region
	var rect_point_1 = point_1
	var rect_point_2 = Vector3(point_2.x, point_1.y, point_1.z)
	var rect_point_3 = Vector3(point_2.x, point_2.y, point_1.z)
	var rect_point_4 = Vector3(point_1.x, point_2.y, point_1.z)
	var rect_point_5 = Vector3(point_1.x, point_1.y, point_2.z)
	var rect_point_6 = Vector3(point_2.x, point_1.y, point_2.z)
	var rect_point_7 = Vector3(point_1.x, point_2.y, point_2.z)
	var rect_point_8 = point_2
	
	#draws the lines that make up the rectangular region
	draw_line(rect_point_1, rect_point_2)
	draw_line(rect_point_1, rect_point_4)
	draw_line(rect_point_1, rect_point_5)
	
	draw_line(rect_point_2, rect_point_3)
	draw_line(rect_point_2, rect_point_6)
	
	draw_line(rect_point_3, rect_point_4)
	draw_line(rect_point_3, rect_point_8)
	
	draw_line(rect_point_4, rect_point_7)
	
	draw_line(rect_point_5, rect_point_6)
	draw_line(rect_point_5, rect_point_7)
	
	draw_line(rect_point_6, rect_point_8)
	
	draw_line(rect_point_7, rect_point_8)

func _ready():
	point_1 = $Point1.position
	point_2 = $Point2.position
	draw_region()
