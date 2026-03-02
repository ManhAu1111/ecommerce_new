<script setup>
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    show: Boolean,
    order: Object
})

const emit = defineEmits(['close'])

const form = useForm({
    status: ''
})

watch(() => props.order, (newOrder) => {
    if (newOrder) form.status = newOrder.status
})

const getStatusLabel = (status) => {
    const labels = {
        'pending': 'Chờ duyệt (COD)',
        'paid': 'Đã thanh toán (MoMo)',
        'delivering': 'Đang giao hàng',
        'completed': 'Đã hoàn thành',
        'cancelled': 'Đã hủy'
    }
    return labels[status] || status
}

const submitStatus = () => {
    form.patch(route('admin.orders.updateStatus', props.order.id), {
        preserveScroll: true,
        onSuccess: () => emit('close')
    })
}

const closeModal = () => emit('close')
</script>

<template>
    <div v-if="show && order" class="modal-overlay" @click.self="closeModal">
        <div class="modal-card detail-modal">
            <div class="modal-header">
                <h2 class="title">CHI TIẾT ĐƠN HÀNG #{{ order.id }}</h2>
                <button type="button" class="close-btn" @click="closeModal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="modal-grid">
                    <div class="col-left">
                        <div class="form-group info-box">
                            <label class="label header-label">Thông tin giao hàng</label>
                            <div class="info-content">
                                <p><strong>Khách hàng:</strong> {{ order.receiver_name }}</p>
                                <p><strong>Điện thoại:</strong> {{ order.receiver_phone }}</p>
                                <p><strong>Địa chỉ:</strong> {{ order.full_address }}</p>
                                <p><strong>Thanh toán:</strong> {{ order.payment_method === 'momo' ? 'Ví MoMo' : 'COD'
                                    }}</p>
                                <p v-if="order.note"><strong>Ghi chú:</strong> {{ order.note }}</p>
                            </div>
                        </div>

                        <div class="status-update-group">
                            <label class="header-label">Cập nhật trạng thái</label>
                            <div class="status-wrapper">
                                <select v-model="form.status" class="select-box"
                                    :disabled="order.status === 'completed' || order.status === 'cancelled'">
                                    <option value="pending" disabled>Chờ duyệt</option>
                                    <option value="paid" disabled>Đã thanh toán</option>
                                    <option value="delivering">Đang giao hàng</option>
                                    <option value="completed">Đã hoàn thành</option>
                                    <option value="cancelled">Đã hủy đơn</option>
                                </select>
                                <p class="status-hint">
                                    <span class="hint-icon">ⓘ</span> Tuân thủ luồng: Chờ duyệt &rarr; Đang giao &rarr;
                                    Hoàn thành/Hủy
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-right">
                        <label class="label header-label">Sản phẩm trong đơn</label>
                        <div class="items-list">
                            <div v-for="item in order.items" :key="item.id" class="item-card">
                                <img :src="item.product.primary_image ? item.product.primary_image.image_url : '/assets/img/default.jpg'"
                                    class="item-img" />
                                <div class="item-info">
                                    <p class="item-name">{{ item.product.name }}</p>
                                    <p class="item-meta">{{ item.quantity }} x {{ Number(item.price).toLocaleString()
                                        }}đ</p>
                                </div>
                                <div class="item-total">
                                    {{ (item.quantity * item.price).toLocaleString() }}đ
                                </div>
                            </div>
                        </div>

                        <div class="order-totals">
                            <div class="total-row">
                                <span>Phí vận chuyển:</span>
                                <span>{{ Number(order.shipping_fee || 0).toLocaleString() }}đ</span>
                            </div>
                            <div class="total-row grand-total">
                                <span>Tổng cộng:</span>
                                <span>{{ Number(order.total_price).toLocaleString() }}đ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" @click="closeModal">Đóng</button>
                <button v-if="order.status !== 'completed' && order.status !== 'cancelled'" type="button"
                    class="btn-submit" @click="submitStatus" :disabled="form.processing">
                    {{ form.processing ? 'Đang lưu...' : 'Lưu thay đổi' }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Thừa hưởng style từ ProductModal */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(3px);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-card {
    background: #fff;
    width: 1000px;
    max-width: 95vw;
    max-height: 90vh;
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: popIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.modal-header {
    padding: 15px 25px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.title {
    font-size: 18px;
    font-weight: 700;
    color: #0f766e;
}

.modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 25px;
}

.modal-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 35px;
}

/* Chi tiết đơn hàng */
.info-box {
    background: #f8fcfb;
    border: 1px solid #bce3db;
    padding: 20px;
    border-radius: 10px;
}

.info-content p {
    margin-bottom: 10px;
    font-size: 15px;
    color: #333;
    line-height: 1.5;
}

.info-content p:last-child {
    margin-bottom: 0;
}

.header-label {
    font-weight: 700;
    color: #0f766e;
    margin-bottom: 18px;
    display: block;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 8px;
    font-size: 16px;
}

.items-list {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    max-height: 380px;
    overflow-y: auto;
    background: #fff;
}

.item-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    border-bottom: 1px solid #f3f4f6;
    transition: background 0.2s;
}

.item-card:hover {
    background: #f8fafc;
}

.item-card:last-child {
    border-bottom: none;
}

.item-img {
    width: 65px;
    height: 65px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #eee;
}

.item-info {
    flex: 1;
}

.item-name {
    font-weight: 600;
    font-size: 15px;
    color: #1e293b;
    margin-bottom: 5px;
}

.item-meta {
    font-size: 14px;
    color: #64748b;
}

.item-total {
    font-weight: 700;
    color: #0f766e;
    font-size: 15px;
}

.order-totals {
    margin-top: 25px;
    padding: 20px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 15px;
    color: #475569;
}

.total-row:last-child {
    margin-bottom: 0;
}

.grand-total {
    border-top: 1px dashed #cbd5e1;
    padding-top: 15px;
    margin-top: 15px;
    font-weight: 800;
    font-size: 19px;
    color: #0f766e;
}

/* Cập nhật trạng thái */
.status-update-group {
    margin-top: 30px;
    background: #eff6f5;
    border: 1px solid #bce3db;
    padding: 20px;
    border-radius: 10px;
}

.status-update-group .header-label {
    color: #0f766e;
    margin-bottom: 15px;
    border-bottom: none;
    padding-bottom: 0;
    font-size: 16px;
}

.select-box {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #bce3db;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    background: #fff;
    color: #333;
    transition: all 0.2s;
    outline: none;
}

.select-box:focus {
    border-color: #0f766e;
    box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
}

.select-box:disabled {
    background: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
    border-color: #e2e8f0;
}

.status-hint {
    font-size: 13px;
    color: #5aa19b;
    margin-top: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-style: italic;
}

.hint-icon {
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
}

/* Footer & Buttons */
.modal-footer {
    padding: 20px 25px;
    border-top: 1px solid #f0f0f0;
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    background-color: #fcfcfc;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
}

.btn-submit {
    background: #0f766e;
    color: white;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    font-size: 15px;
}

.btn-submit:hover:not(:disabled) {
    background: #0d655e;
    transform: translateY(-1px);
}

.btn-submit:active:not(:disabled) {
    transform: translateY(0);
}

.btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-cancel {
    background: #fff;
    border: 1px solid #cbd5e1;
    color: #475569;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 15px;
}

.btn-cancel:hover {
    background: #f1f5f9;
    color: #0f172a;
    border-color: #94a3b8;
}

.close-btn {
    background: none;
    border: none;
    font-size: 26px;
    color: #94a3b8;
    cursor: pointer;
    line-height: 1;
    padding: 0;
    transition: color 0.2s;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close-btn:hover {
    color: #f43f5e;
}

/* Thay đổi Modal trên Mobile */
@media (max-width: 768px) {
    .modal-overlay {
        padding: 10px;
    }

    .modal-card {
        width: 100%;
        max-width: 100%;
        border-radius: 8px;
        max-height: 95vh;
    }

    .modal-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .modal-body {
        padding: 15px;
    }

    .modal-footer {
        padding: 15px;
    }
}
</style>