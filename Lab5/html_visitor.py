class HTMLElement:
    def __init__(self, tag_name, text=""):
        self.tag_name = tag_name
        self.text = text
        self.children = []

    def add_child(self, child):
        self.children.append(child)

    def accept(self, visitor):
        visitor.visit(self)
        for child in self.children:
            child.accept(visitor)



class Visitor:
    def visit(self, element):
        pass



class TagCountVisitor(Visitor):
    def __init__(self):
        self.counts = {}

    def visit(self, element):
        tag = element.tag_name
        self.counts[tag] = self.counts.get(tag, 0) + 1



class JSONExportVisitor(Visitor):
    def __init__(self):
        self.result = None

    def visit(self, element):
        if not hasattr(element, 'json_node'):
            element.json_node = {
                "tag": element.tag_name,
                "text": element.text,
                "children": []
            }
        for child in element.children:
            child.accept(self)
            element.json_node["children"].append(child.json_node)
        self.result = element.json_node


def main():
    root = HTMLElement("div")
    header = HTMLElement("h1", "Hello")
    paragraph = HTMLElement("p", "Some text")
    span = HTMLElement("span", "inline")

    root.add_child(header)
    root.add_child(paragraph)
    paragraph.add_child(span)

    counter = TagCountVisitor()
    root.accept(counter)
    print("Tag counts:", counter.counts)

    exporter = JSONExportVisitor()
    root.accept(exporter)
    import json
    print("JSON export:\n", json.dumps(exporter.result, indent=2))


if __name__ == "__main__":
    main()
