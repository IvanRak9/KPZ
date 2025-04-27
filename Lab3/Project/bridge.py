class Shape:
    def __init__(self, renderer):
        self.renderer = renderer

    def render(self):
        pass


class VectorRenderer:
    def render_circle(self):
        print("Drawing Circle as vector")

    def render_square(self):
        print("Drawing Square as vector")

    def render_triangle(self):
        print("Drawing Triangle as vector")


class RasterRenderer:
    def render_circle(self):
        print("Drawing Circle as pixels")

    def render_square(self):
        print("Drawing Square as pixels")

    def render_triangle(self):
        print("Drawing Triangle as pixels")


# Дочірні класи фігур
class Circle(Shape):
    def render(self):
        self.renderer.render_circle()


class Square(Shape):
    def render(self):
        self.renderer.render_square()


class Triangle(Shape):
    def render(self):
        self.renderer.render_triangle()


def main():
    vector_renderer = VectorRenderer()
    raster_renderer = RasterRenderer()

    circle = Circle(vector_renderer)
    square = Square(raster_renderer)
    triangle = Triangle(vector_renderer)

    circle.render()
    square.render()
    triangle.render()


if __name__ == "__main__":
    main()
