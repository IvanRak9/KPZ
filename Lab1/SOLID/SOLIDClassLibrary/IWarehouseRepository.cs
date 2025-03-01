namespace SOLIDClassLibrary.Warehouse
{
    public interface IWarehouseRepository
    {
        void AddProduct(Product.Product product);
        void RemoveProduct(Product.Product product);
        void UpdateProduct(string productId, Product.Product newProduct);
        Product.Product? GetProductByIdOrDefault(string id);
        Product.Product? GetProductByNameOrDefault(string name);
    }
}