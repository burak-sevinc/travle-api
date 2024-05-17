echo "Building API documentation..."
rm -rf public/docs
echo "Removing old documentation..."
mkdir public/docs
echo "Creating new documentation directory..."
cp -r docs/* public/docs
echo "Copying new documentation..."
echo "API documentation built successfully!"
