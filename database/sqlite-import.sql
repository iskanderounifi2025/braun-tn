-- Categories
INSERT INTO categories (id, name, slug, image, parent_id, created_at, updated_at) VALUES
(50, 'Silk·épil 3', 'silk-pil-3', NULL, NULL, '2025-04-25 07:23:50', '2025-04-25 07:23:50'),
(51, 'Face Spa', 'face-spa', NULL, NULL, '2025-04-25 07:24:16', '2025-04-25 07:24:16'),
(52, 'Silk·épil 5', 'silk-pil-5', NULL, NULL, '2025-04-25 07:24:29', '2025-04-25 07:24:29'),
(53, 'Silk·épil 9', 'silk-pil-9', NULL, NULL, '2025-04-25 07:24:40', '2025-04-25 07:24:40'),
(54, 'Silk·épil 9 Flex', 'silk-pil-9-flex', NULL, NULL, '2025-04-25 07:24:48', '2025-04-25 07:24:48'),
(59, 'ter', 'ter', NULL, '54', '2025-05-02 13:13:02', '2025-05-02 13:13:02');

-- Products
INSERT INTO products (id, name, slug, description, regular_price, sale_price, SKU, stock_status, quantity, category_id, created_at, updated_at) VALUES
(12, 'SES5500', 'ses5500', 'l''épilateur Braun se 5-500 se caractérise par une technologie de 28 pinces qui permet une épilation efficace et rapide. Il est équipé d''un système de massage actif qui réduit la sensation de douleur pendant l''épilation. L''appareil est doté d''une tête pivotante qui s''adapte aux contours du corps pour une épilation optimale. Il est également livré avec un accessoire de rasage et un accessoire de coupe pour une utilisation polyvalente.', 299.00, NULL, 'SES5500', 'instock', 10, 52, '2025-05-02 13:06:52', '2025-05-02 13:06:52'); 