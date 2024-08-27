<template>
    <div>
        <div class="d-flex justify-content-center align-items-center">            
            <div class="spinner-border spinner-border-sm text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <strong class="ms-2">
                {{ title }}
            </strong>
        </div>
    </div>
</template>

<script>
export default {
    name: "Loading",
    props: {
        title: String
    }
}
</script>

<style lang="scss" scoped></style>