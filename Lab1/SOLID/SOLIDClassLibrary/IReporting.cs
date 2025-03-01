namespace SOLIDClassLibrary.Reporting
{
    // The fourth SOLID principle (interface was created)
    public interface IReporting
    {
        void Added();
        void Removed();
        void Left(int count);
    }
}